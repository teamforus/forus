pragma solidity ^0.4.17;

import { Asset } from './Asset.sol';
import { Identity } from './Identity.sol';
import { IdentityManager } from './IdentityManager.sol';
import { Service } from './Service.sol';
import { Token } from './Token.sol'; 
import { Validated } from './Validated.sol';

contract PlatformForus {

    struct AssetWrapper {
        uint index;
        mapping(address => uint) prices;
        Identity provider;
    }

    event AssetAdded(Asset asset, address provider);

    event AssetPurchased(address by, Asset asset, Token token, uint price, address from);
    event ServicePurchased(address by, Service asset, Token token, address from, uint amount);

    event TokenAdded(address token, address sponsor);
    event TokenGranted(address token, address sponsor, address requester, uint amount);
    event TokenReturned(address token, address sponsor, address provider, uint amount);

    address _owner; 

    IdentityManager private _identities;

    mapping(address => AssetWrapper) _assets;
    Asset[] private _assetList;
    Service[] private _services;
    Token[] private _tokens;

    function PlatformForus(IdentityManager manager) public {
        if (!manager.accountExists(msg.sender)) {
            // The EVM is unable to calculate the cost of creating an identity
            // in the manager, so the identity has to be known. 
            revert();
        }
        _identities = manager;
        _owner = sender();
    }

    function assetExists(Asset asset) public view returns (bool exists) {
        for (uint i = 0; i < _assetList.length; i++) {
            if (address(asset) == address(_assetList[i])) {
                return true;
            }
        }
        return false;
    }

    function getBalanceOf(address identity, Token token) public view returns (uint balance, uint allowance) {
        return (token.balanceOf(identity), token.allowance(identity, this));
    }

    function serviceExists(Service service) public view returns (bool exists) {
        for (uint i = 0; i < _services.length; i++) {
            if (address(service) == address(_services[i])) {
                return true;
            }
        }
        return false;
    }

    function tokenExists(Token token) public view returns (bool exists) {
        for (uint i = 0; i < _tokens.length; i++) {
            if (address(token) == address(_tokens[i])) {
                return true;
            }
        }
        return false;
    }

    function sender() private returns (address identityAddress) {
        return _identities.convertToIdentity(msg.sender);
    }

    /*** Requester methods */

    function purchaseAsset(Asset asset, Token token) public {
        require(_assets[asset].prices[token] > 0);
        require(token.balanceOf(sender()) >= _assets[asset].prices[token]);
        require(_assets[asset].provider == asset.getOwner());
        if (asset.sell(sender(), token, _assets[asset].prices[token])) {
            AssetPurchased(sender(), asset, token, _assets[asset].prices[token], _assets[asset].provider);
            delete _assetList[_assets[asset].index];
            delete _assets[asset];
        }
    }

    function purchaseService(Service service, Token token, uint amount) public {
        require(token.balanceOf(sender()) >= service.getPrice(token));
        require(service.isValidERC20(token));
        if (service.purchaseFor(sender(), token, amount)) {
            ServicePurchased(sender(), service, token, service.getOwner(), amount);
        }
    }

    function requestFund(Token token) public returns (bool success) {
        Identity identity = Identity(sender());
        identity.addPermission(token);
        if (token.requestFor(identity)) {
            TokenGranted(token, token.getOwner(), identity, token.getFundSize());
            return true;
        } 
        return false;
    } 

    /*** Provider methods */

    function addAvailabilityToService(Service service, uint add) public {
        require(service.isOwner(sender()));
        service.addAvailability(add);
    }

    /***
        For "addValidationRule", see Sponsor methods
     */

    function createAsset(string name) public returns (Asset newAsset) {
        Identity identity = Identity(sender());
        uint index = _assetList.push(new Asset(this, name));
        _assets[_assetList[index]] = AssetWrapper({provider: identity, index: index});
        AssetAdded(_assetList[index], sender());
        return _assetList[index];
    }
    /***
        For "enable" on services, see Sponsor methods
     */

    function setAssetPrice(Asset asset, Token token, uint newPrice) public {
        require(asset.isOwner(sender()));
        _assets[asset].prices[token] = newPrice;
    }

    function setAvailabilityOfService(Service service, uint newAvailable) public {
        require(service.isOwner(sender()));
        service.setAvailability(newAvailable);
    }

    function setServicePrice(Token token, Service service, uint price) public {
        require(service.isOwner(sender()));
        service.setPrice(token, price);
    }

    /*** SPONSOR METHODS */
    function addProvider(Identity providerIdentity, Token token) public {
        require(token.isOwner(sender()));
        token.addProvider(providerIdentity);
    }

    function addValidationRule(Validated validated, string key, string operator, uint value) public returns (bool success) {
        require(validated.isOwner(sender()));
        return (validated.addValidationRule(key, operator, value) > 0);
    }

    function createToken(string name, uint supplySize, uint fundSize) public returns (Token newToken) {
        uint index = _tokens.push(new Token(name, sender(), supplySize, fundSize));
        TokenAdded(_tokens[index], sender());
        return _tokens[index];
    }

    function enable(Validated validated) public {
        require(validated.isOwner(sender()));
        validated.enable();
    }
}