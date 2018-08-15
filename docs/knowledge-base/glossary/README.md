## Glossary

| term | definition |
|---|---|
| platform forus | t.b.d.
| me app | t.b.d.
| repository | A repository is in context of the Forus platform, a folder that is being tracked by a version control system named Git. It is primarily used to store the source code of a part of the platform. Each seperate service is stored in a seperate repository. |
| services | A service is an extension of the Forus platform that has a primary function for a specific cause like a database connection. More examples are: api connections (BUNQ, KVK), DigiD connection, connections with a cryptocurrency exchange like Kraken.com. These extensions are services that the Forus Foundation delivers and can not be decentralized.
| module | A module is a specific function that is only used by one customer of the Forus platform. It is written modular so other parties could also benefit of this module. It can be a generic user interface or a specific one.
| identity | An identity in it core is a key pair (Private/Public) which a user can use to identify himself by encrypting a message and sharing the decryption key. This way we can store any personal data, encrypt it and share the data with an external party.
| key | A key pair is asymmetric cryptography. Wikipedia has a great artical about this kind of encryption. https://en.wikipedia.org/wiki/Public-key_cryptography
| address |An address is an Ethereum address that is derived from a public key by a hash function.
| hash functions | A hashing function is a cryptographic function that can be used one-way to convert any type of data to an random string of letters and digits. https://en.wikipedia.org/wiki/Hash_function
| poc | A poc stands for Proof of Concept. It is used to show how a more technology works. Forus uses a poc to setup a demo with stakeholders to show how the platform works and where any organisational or technical hickups may be.
| prototype | A prototype is a product that is used within a PoC. It is not yet production-ready software.
| demo | A demo is an example of a product to show how it works and is setup to show the best user experience.
| api | An api is a application programming interface for a software application. Just as a graphical user interface makes it easier for people to use programs, application programming interfaces make it easier for developers to use certain technologies in building applications. The Forus api should make it easy for any software company to write a application for the Forus platform.
| record | A record is an attribute. We see a record as an key-value pair. Example: name (key) = John (value)
| claim | A claim is a record that is set to a identity. It can be a self-claim.
| validation | A validation is a cryptographic signature that is applied to specific records.
| wallet | A wallet is a cryptowallet where cryptocurrency or smart contract can be stored like Tokens and Assets.
| tokens | A token is a standard ERC-20 smart contract. This standard provides basic functionality to transfer tokens, as well as allow tokens to be approved so they can be spent by another on-chain third party. A token can be a self made cryptocurrency but in the form as a smart contract on the Ethereum blockchain.
| assets | An asset is a ERC721 smart contract. It a non-fungible token standard. It can be used to register tokens that are unique. A token can represent any form of property like digital paintings, in-game items or physical items.
| vouchers | A voucher is an representation of an allowance. An allowance is a function of the ERC20-contract. A identity allows another party to substract a specific amount of tokens from their balance in the smart contract.
| raw transaction |A raw transaction is JSON-object example: {"nonce":"0x00", "gasPrice":"0x00","gasLimit":"0x5208", "to":"0xB0711ABA8Dc9b105DA40BA7e06daB1Cc2EA32A96", "value":"0x4563918244f40000", "data":"0x", "chainId":1}
| signed transaction | A signed transaction is a JSON-object that is signed by a ethereum private key.
| JSON | JSON stands for JavaScript Object Notation. JSON is an open-standard file format that uses human-readable text to transmit data objects consisting of attribute–value pairs and array data types (or any other serializable value)
| block | A block is a set of transactions finalized by a Miner.
| mine | Mining is cryptographic race to find the a hash that starts with multiple zero's depending on the dificulty. It uses a lot of power to calculate this cryptographic function. The person who wins the race gets around 0.1 ether and may finalize the block.
| ipfs | Interplanetary File-system. A decentralized way of storing data.
| ethereum | Ethereum is the name of a decentralized blockchain network. The foundations vision is that the Ethereum will be fast world supercomputer.
| ERC | Ethereum Request for Comment
