pragma solidity ^0.4.17;

import { ERC20 } from './ERC20.sol';
import { Vendored } from './Vendored.sol';

contract Token is ERC20, Vendored {

    event InsufficientSupply(uint supplySize, uint fundSize);
    event TokenGranted();

    uint constant private DECIMALS = 2;

    mapping (address => mapping(address => uint)) _allowance;
    uint private _fundSize;
    string private _name;
    bool private _providerLocked = true;
    address[] private _providers;
    uint private _totalSupply;
    mapping (address => uint) private _wallets;

    modifier providerApproved(address identity) {
        require(!_providerLocked || isProvider(identity) || isProvider(msg.sender));
        _;
    }

    modifier requiresAllowance(address tokenOwner, address spender, uint amount) {
        require(allowance(tokenOwner, spender) >= amount);
        _;
    }

    modifier requiresSufficientFund(address sender, uint amount) {
        require(_wallets[sender] >= amount);
        _;
    }

    function Token(string name, address owner, uint totalSupply, uint fundSize) public Vendored(owner) {
        _fundSize = fundSize;
        _name = name;
        _totalSupply = totalSupply;
    }

    function addProvider(address provider) public requiresVendor(msg.sender) returns (uint index) {
        require(!isProvider(provider));
        return _providers.push(provider);
    }

    function allowance(address tokenOwner, address spender) public view returns (uint remaining) {
        return _allowance[tokenOwner][spender];
    }

    function approve(address spender, uint tokens) public requiresSufficientFund(msg.sender, tokens - _allowance[msg.sender][spender]) returns (bool success) {
        // Return remaining allowance, basically a reset.
        _wallets[msg.sender] += _allowance[msg.sender][spender];
        _wallets[msg.sender] -= tokens;
        _allowance[msg.sender][spender] = tokens;
        return success;
    }
 
    function balanceOf(address identity) public view returns (uint balance) {
        return (_wallets[identity]);
    }
    
    function getFundSize() public view returns (uint fundSize) {
        return _fundSize;
    }

    function getName() public view returns (string name) {
        return _name;
    }

    function getSupplySize() public view returns (uint supplySize) {
        return balanceOf(getOwner());
    }

    function isProvider(address identity) public view returns (bool valid) {
        for (uint i = 0; i < _providers.length; i++) {
            if (address(_providers[i]) == identity) {
                return true;
            }
        }
        return false;
    }

    function removeProvider(address provider) public requiresVendor(msg.sender) {
        for (uint i = 0; i < _providers.length; i++) {
            if (_providers[i] == provider) {
                delete _providers[i];
                return;
            }
        }
        // No changes, undo and refund gas
        revert();
    }

    function requestFor(address identity) public returns (bool success) {
        require(validate(identity));
        if (getSupplySize() < getFundSize()) {
            InsufficientSupply(getSupplySize(), getFundSize());
            return false;
        }
        _wallets[getOwner()] -= getFundSize();
        _wallets[identity] += getFundSize();
        return true;
    }

    function totalSupply() public view returns (uint) {
        return _totalSupply;
    }

    function transfer(address to, uint amount) public providerApproved(to) requiresSufficientFund(msg.sender, amount) returns (bool success) {
        _wallets[msg.sender] -= amount;
        _wallets[to] += amount;
        return true;
    }

    function transferFrom(address from, address to, uint amount) public providerApproved(to) requiresAllowance(from, to, amount) returns (bool success) {
        _allowance[from][to] -= amount;
        _wallets[to] += amount;
        return true;
    }
}