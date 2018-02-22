pragma solidity ^0.4.17;

contract StringHelper {

    function getCharacter(byte character) private pure returns (uint) {
        uint c = uint(character);
        if (!(c >= 97 && c <= 122)) {
            if (c >= 65 && c <= 90) {
                c += 32;
            } else {
                // Perhaps add valid characters (like periods)
                c = 0;
            }
        }   
        return c;
    }

    function indexModifier() private pure returns (uint) {
        return 31;
    }

    function stringToInt(string characters) external pure returns (uint result) {
        bytes memory b = bytes(characters);
        uint i;
        result = 0;
        for (i = 0; i < b.length; i++) {
            uint c = getCharacter(b[i]);
            if (c > 0) {
                result = result * 100 + (c - indexModifier());
            }
        }
        return result;
    }
}