pragma solidity ^0.4.17;

import { Identity } from './Identity.sol';
import { Owned } from './Owned.sol';
import { StringHelper } from './StringHelper.sol';

contract Validated is Owned {
    uint _currentIndex = 1;
    bool private _enabled = false;
    uint[] private _validationIndexes;
    mapping (uint => ValidationRule) private _validationRules;

    event Enabled();
    event ValidationRuleAdded(uint index, string key, string operator, uint value);
    event ValidationRuleRemoved(uint index);

    struct ValidationRule {
        string key;
        bytes2 operator;
        uint comparison;
    }

    modifier cannotBeEnabled() {
        require (!_enabled);
        _;
    }

    modifier mustBeEnabled() {
        require (_enabled);
        _;
    }

    modifier requiresPermissionFrom(Identity identity) {
        require (hasPermission(identity));
        _;
    }

    function Validated(address owner) public Owned(owner) {
        
    }

    function addValidationRule(string key, string operator, uint value) public requiresOwner(msg.sender) cannotBeEnabled() returns (uint index) {
        if (!isValidOperator(operator)) {
            return 0;
        }
        bytes2 operatorBytes = stringToOperator(operator);
        _validationRules[++_currentIndex].key = key;
        _validationRules[_currentIndex].operator = operatorBytes;
        _validationRules[_currentIndex].comparison = value;
        _validationIndexes.push(_currentIndex);
        ValidationRuleAdded(_currentIndex, key, operator, value);
        return _currentIndex;
    }

    function enable() public requiresOwner(msg.sender) cannotBeEnabled() {
        _enabled = true; 
        Enabled();
    }

    function getValidOperators() public pure returns (bytes2[6] operators) {
        bytes2[6] memory ret;
        ret[0] = 0x3c00; // <
        ret[1] = 0x3c3d; // <=
        ret[2] = 0x3d3d; // ==
        ret[3] = 0x3e3d; // >=
        ret[4] = 0x3e00; // >
        ret[5] = 0x213d; // !=
        return ret;
    }

    function hasPermission(Identity identity) public view returns (bool has) {
        return identity.hasPermission(address(this));
    }

    function isValidOperator(string stringOperator) public pure returns (bool) {
        if (bytes(stringOperator).length > 2) {
            return false;
        }
        bytes2 operator = stringToOperator(stringOperator);
        bytes2[6] memory operators = getValidOperators();
        for (uint i = 0; i < operators.length; i++) {
            if (operator == operators[i]) {
                return true;
            }
        }
        return false;
    }

    function removeValidationRule(uint index) public requiresOwner(msg.sender) cannotBeEnabled() {
        delete _validationRules[index];
        for (uint i = 0; i < _validationIndexes.length; i ++) {
            if (_validationIndexes[i] == index) {
                delete _validationIndexes[i];
                ValidationRuleRemoved(index);
            }
        }
    }

    function stringToOperator(string operatorString) private pure returns (bytes2 operator) {
        operator = 0x0000;
        assembly {
            operator := mload(add(operatorString, 32))
        }
        return operator;
    }

    function validate(address identity) public mustBeEnabled() view returns (bool isValid) {
        for (uint i = 0; i < _validationIndexes.length; i++) {
            if (!validateValue(Identity(identity), _validationIndexes[i])) {
                return false;
            }
        }
        return true; 
    }

    function validateValue(Identity identity, uint ruleIndex) private view returns (bool isValid) {
        ValidationRule memory rule = _validationRules[ruleIndex];
        if (rule.operator > 0) {
            var ( value, voteCount ) = identity.getValue(rule.key);
            bytes2 operator = rule.operator;
            if (voteCount > 0) {
                if (operator == 0x3e3d) {               // >=
                    return value >= rule.comparison;
                } else if (operator == 0x3c3d) {        // <=
                    return value <= rule.comparison;
                } else if (operator == 0x3d3d) {        // ==
                    return value == rule.comparison;
                } else if (operator == 0x213d) {        // !=
                    return value != rule.comparison;
                } else if (operator == 0x3e00) {        //  > 
                    return value > rule.comparison;
                } else if (operator == 0x3c00) {        //  <
                    return value < rule.comparison;
                } 
            }
        }
        return false;
    }
}