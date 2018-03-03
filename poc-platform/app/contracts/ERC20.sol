pragma solidity ^0.4.17;

contract ERC20 {
    
    function allowance(address tokenOwner, address spender) public view returns (uint remaining);
    function approve(address spender, uint tokens) public returns (bool success);
    function balanceOf(address tokenOwner) public view returns (uint balance);
    function totalSupply() public view returns (uint);
    function transfer(address to, uint tokens) public returns (bool success);
    function transferFrom(address from, address to, uint tokens) public returns (bool success);

    event Transfer(address indexed from, address indexed to, uint tokens);
    event Approval(address indexed tokenOwner, address indexed spender, uint tokens);
}