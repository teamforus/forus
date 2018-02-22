pragma solidity ^0.4.17;

import { ERC20 } from './ERC20.sol';
import { Vendored } from './Vendored.sol';

contract Service is Vendored {

    event PriceChanged(address token, uint price);
    event AvailabilityChanged(uint newAvailable);

    uint private _available;
    string private _name;
    mapping (address => uint) private _prices;
    mapping (address => uint) private _purchases;
    //mapping (address => bool) private _vendors;

    modifier requiresAcceptedERC20(ERC20 token) {
        require (_prices[token] > 0);
        _;
    }

    modifier requiresAvailable(uint amount) {
        require((!isLimited()) || _available >= amount);
        _;
    }

    modifier requiresSufficientFund(address sender, ERC20 token, uint amount) {
        require(token.balanceOf(sender) > amount * getPrice(token));
        _;
    }

    function Service(string name, address owner, uint available) public Vendored(address(owner)) {
        _available = available;
        _name = name;
    }

    function addAvailability(uint available) public requiresVendor(msg.sender) {
        _available += available;
        AvailabilityChanged(_available);
    }

    function getName() public view returns (string name) {
        return _name;
    }

    function getPrice(address token) public view returns (uint price) {
        return _prices[token];
    }

    function getAvailable() public view returns (uint available) {
        return _available;
    }

    function isLimited() public view returns (bool limited) {
        return _available >= 0;
    }

    function isValidERC20(address token) public view returns (bool valid) {
        return _prices[token] > 0;
    } 

    function purchaseFor(address identity, ERC20 token) public requiresAcceptedERC20(token) requiresVendor(msg.sender) returns (bool success) {
        return purchaseFor(identity, token, 1); 
    }

    function purchaseFor(address identity, ERC20 token, uint amount) public requiresAcceptedERC20(token) requiresVendor(msg.sender) returns (bool success) {
        require(token.allowance(identity, this) >= amount);
        require(validate(identity));
        token.transferFrom(identity, getOwner(), amount);
        _purchases[identity] += amount;
        if (isLimited()) {
            _available -= amount;
            AvailabilityChanged(_available);
        }
        return true;
    }

    function removeAvailable(uint amount) public requiresVendor(msg.sender) returns (bool availableChanged, uint newAvailable) {
        if (isLimited()) {
            if (_available > amount) {
                newAvailable = _available - amount;
            } else {
                newAvailable = 0;
            }
            _available = newAvailable;
        } else {
            revert();
        }
        return (true, newAvailable);
    }

    function setPrice(address token, uint price) public requiresVendor(msg.sender) {
        _prices[token] = price;
        PriceChanged(token, price);
    }

    function setAvailability(uint newAvailable) public requiresVendor(msg.sender) {
        _available = newAvailable;
        AvailabilityChanged(newAvailable);
    }
}