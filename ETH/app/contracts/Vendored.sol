pragma solidity ^0.4.17;

import { Validated } from './Validated.sol';

contract Vendored is Validated {
    // Helper class for anything that may be traded or used through a vendor (like Forus Vendor)

    mapping(address => bool) private _vendors;

    modifier requiresVendor(address sender) {
        require (isVendor(sender) || isOwner(sender));
        _;
    }

    function Vendored(address owner) public Validated(owner) {
        _vendors[owner] = true;
        if (msg.sender != owner) {
            _vendors[msg.sender] = true;
        }
    }

    function addVendor(address vendor) public requiresOwner(msg.sender) {
        _vendors[vendor] = true;
    }

    function isVendor(address vendor) public view returns (bool) {
        return (_vendors[vendor]);
    }

    function removeVendor(address vendor) public requiresOwner(msg.sender) {
        _vendors[vendor] = false;
    }
    
}