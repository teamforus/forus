pragma solidity ^0.4.17;

import { Identity } from './Identity.sol';

contract IdentityManager {

    event IdentityCreated(address identity);

    mapping(address => Identity) private _identityMapping;
    mapping(address => bool) private _identities;

    function accountExists(address account) public view returns (bool exists) {
        return (address(_identityMapping[account]) != 0x0);
    }

    function convertToIdentity(address account) public returns (Identity identity) {
        if ((!accountExists(account)) && (!isIdentity(account))) {
            createIdentity(account);
        }
        return getIdentity(account);
    }

    function createIdentity(address account) private returns (address newIdentity) {
        _identityMapping[account] = new Identity(account);
        newIdentity = address(_identityMapping[account]);
        _identities[newIdentity] = true;
        IdentityCreated(newIdentity); 
        return (newIdentity);
    }

    function getIdentity(address account) public view returns (Identity identity) {
        if (isIdentity(account)) {
            // In case the given account is already an identity
            return Identity(account);
        }
        return _identityMapping[account];
    }

    function isIdentity(address identity) public view returns (bool) {
        return _identities[identity];
    }
    
}