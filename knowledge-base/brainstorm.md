# Topics

## me

### wallet
* what can I keep in my wallet?
Since the arrival of blockchain, it has become possible to have ownership of digital assets, with the most populair and first example of cryptocurrency. The me app connects to ethereum to enable holding your ether and other types of assets that ethereum supports. Due to the nature of ethereum and it's ability to host [smart contracts]() the possibilities are nearly limitless. Will initially support ERC20 tokens and ERC721 non-fungible assets. Next to crypto assets, me connects to forus to enable hosting your vouchers. Initially vouchers are hosted by forus and represent euro's. In the future me is planned to hold ether vouchers as well. This way the need for trusting foundation forus is removed. The current roadblocks to this happening are: providers should be willing to accept ether. sponsors should be willing put ether in the funds. The strategy for this is for forus to initially become an exchange, this way either end could decide to offer/accept ether/euro's and forus can exchange to the proper currency. 

### records
* what kind of records can I store?
The way that the records work, it is essentially possible to store any kind of record. Each record should consist of a key and a value. A key is the name of the record; e.g. "name". A value is the actual record; e.g. "john". The record could also be a bigger piece of data, for example an image. The thing that gives the record its value is being signed by a validator. When a user installs the me app, a keypair will be generated. These keys can be used to encrypt files, and also to sign them using [asymetric cryptograpy]().

### identification
* what does it mean to identify myself?
An identity of a me app user contains different elements: an identifier (ethereum adress/public key), assets, and records. The simples form of identification is exposing your addres to a third party. This can either be a (web) application or a different person. This third party can now use this identifier to build up their profile of you in their systems. Comparible to how governemnt uses your social security number to do this. This system still relies on the (centralized) infrastructures of third parties. Secondly, it is possible to share the records you hold yourself with the centralized parties. Since these records are signed, it is possible for you to show the legitimacy of the records, without needing to rely on the party that signed them. [optional: explain zero knowledge proof] Lastly, it is possible to exchange value with third parties. By exposing or learning an address (identity) you know where you can send the resources. 

## forus


## research-and-development
### what would we like to do? what is stopping that?
* private transactions (initially between sponsor and provider) later also from sponsor to requester voucher to provider.
currently all transactions on a public blockchain are, you guessed it, public. There are already blockchains that are using zero-knowledge proofs to enable private transactions on a public chain. 
* giving out funds to an applying party without losing privacy.
a fund is a collection of resources (e.g. ether), a requester can apply for the right to spend this with a provider. A fund has criteria, a requester has records, if the records of the user are equal to the criteria, then the resources get unlocked. Ideally the user can apply for the fund with proof that they posess the right records without exposing the records.

## foundation

## implementation

## knowledge-base 
* Smart contracts.
* Asymetric cryptography.

## notes
* "private browsing"
generally the same public key can be used for different websites. Next to that, users will have a couple different personas that are used in different contexts. E.g. social networks, school, etc. It should also be possible to quickly and easily generate a burner identity. Like when private browsing. 
