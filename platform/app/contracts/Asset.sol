pragma solidity ^0.4.17;

import { ERC20 } from './ERC20.sol';
import { Validated } from './Validated.sol';

contract Asset is Validated {
    
    string private _name;

    function Asset(address owner, string name) public Validated(owner) {
        _name = name;
    }

    function getName() public view returns (string name) {
        return _name;
    }

    function sell(address to, ERC20 token, uint price) public requiresOwner(msg.sender) returns (bool success) {
        require(token.allowance(to, address(this)) >= price);
        require(validate(to));
        token.transferFrom(to, getOwner(), price);
        setOwner(to);
        return true;
    }

}