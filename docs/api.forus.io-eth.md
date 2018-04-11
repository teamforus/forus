# Forus.io platform poc documentation

## Instances
A blockchain instance has his own Ethereum address. 
### Token 
A token has a name, fund size and a condition. A token can be created, requested and owned by any identity.
### Artifact
An artifact has a name, a stock (if wanted), a price and a condition.  An artifact can be created, requested and owned by any identity.
### Identity
Can create, own and request tokens and artifacts. To be able to request tokens and artifacts an identity has to comply to certain conditions like being 18 or having a minimum wage.
### Four roles
The Forus platform knows four roles:
1.	A requester
- 	.. requests tokens that the sponsor supplies
- 	.. spends token to retrieve artifacts.
2.	A sponsor
- 	Supplies tokens
- 	Adds providers who can utilize their token
- 	Sets a condition by setting a key, operator and value. 
  ⋅⋅⋅ Example: key = age, operator= >= (Bigger than), value=18
3.	A provider
-	Supplies artifacts
-	Sets a condition by setting a key, operator and value.
⋅⋅⋅	Example: key = age, operator= >= (Bigger than), value=18
4.	A validator
-	Validates properties about an identity by voting.
Any identity can vote. A vote consist of a key and value. Vote count needs to be bigger than zero for a property to become an usable property.
Example: key = age, value= 16
A token or artifact can check the key and value with a certain condition when an identity gives permission (age >= 18)
## Contracts
There are seven Solidity contracts:
1.	ForusVendor
- Artifacts
-	Token
- IdentityManager
-	Identity
2.	Owned
3.	Validated
Artifacts and Tokens are deployed by the Forus Vendor contract. An Identity is deployed by the Identity Manager. The contracts Owned and Validated are inherited by tokens and artifacts. (tokens can be owned by a validated identity)
### Forus Vendor
The forus vendor contract is the aorta of the forus platform. In this contract a client can listen to multiple event and request all kinds of information. This paragraph defines events, modifiers and two types of methods views and transactions. A view is a call to blockchain, it reads data and the client does not need gas to run a call. A transaction writes data to blockchain and it needs gas to send the transaction (because a miner needs to add the transaction to a new block).
#### Events
ArtifactAdded()
ArtifactAvailability()
ArtifactBought()
ArtifactPriceChanged()
TokenAdded()
TokenGranted()
TokenReturned()
#### Modifiers
RequireAcceptedToken()
RequireBalance()
RequireProvider()
RequireSponsor()
#### Views / Pure
artifactExists()
GetArtifactCount()
getBalance()
getBalanceOf
#### Transactions
ForusVendor()
sender()
purchase().requireBalance().requireAcceptedToken()
requestFund()
addStock().requireProvider()
addArtifact()
createArtifact
setAvailability().requireProvider()
setArtifactPrice().requireProvider()
addProvider().requireSponsor()
addToken()
isSponsor()
