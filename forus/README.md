[![join chat](https://img.shields.io/badge/join%20chat-forus-green.svg)](https://chat.forus.io/channel/forus)

Maintainer | [@danrminds](https://github.com/danrminds)
--- | ---

# Readme
## Why we are making forus

It is currently a very cumbersome process to make resources end up with a target audience. For the sponsor it is hard to find the target audience and spread awareness about the availability of the funds. When receiving a request, it is hard to validate that the requesting party is eligible to recieve the grant. The flow of payments is a very administrative process. For the requesting party this situation is not any better. They usually don't know what they are eligible for, and the application process is usually very labor intensive. Providers also have to do a lot of administration, often working with vouchers or invoice requests.

By applying modern-day technology and human-centered experience design, it is possible to make great steps in improving this process.


## What is forus?

Forus is a platform for the conditional exchange of value. The platform knows four generic actors:

A **sponsor** who makes resources available under certain criteria. 
A **requester** who applies for the resources. A **validator** that signs criteria of requesters. A **provider** who delivers the product or service, and recieves payment from the sponsor.

### The main interaction
**A user** has an [identity](https://github.com/teamforus/concept-identity) that holds properties and assets.  
**An offer** is a product/service made to be available under certain criteria.  

**If** the *properties* of the user equal the *criteria* of the offer **then** perform the transaction.

### Example case of an implementation of Forus
An example of an implementation in which all of these roles would interact, could look like an e-commerce platform for governmental services.

A citizen (requester) could apply for special health-related assistance pledged by a municipality (sponsor), if he/she is entitled to it according to certain criteria arising from predetermined policy.

To check if the citizen meets these criteria a doctor (validator) can be chosen by the municipality to validate the condition of the citizen.

The actual assistance is provided in hospital (provider).

## Roadmap

| # | Title | Discription |
| --- | --- | --- |
| 0.0.0 | Demo | The initial concept for Forus was presented at the Dutch Blockchain hackathon, februari of 2017. It showed a vision for a decentralized platform for the conditional exchange of value that is applicable to funds, subsidies and grants. After winning the hackathon [Foundation Forus](\../readme/foundation/README.md) was founded to continue with bringing this vision into reality. |
| 0.0.1 | Proof of concept | After winning the hackathon the team wanted to test if the concept would succeed in providing real world value. On 1 November 2017 Kindpakket was launched in the municipality of Zuidhorn in the Netherlands. Kindpakket is mostly a tradional application build on a PHP/MySQL stack. The application uses a private ethereum node that is closed off from the internet and can only accessed via an API. This private node contains a single [smart contract](https://github.com/teamforus/rd-zuidhorn-kindpakket-smartcontract-poc) that resembles a cryptotoken, which keeps a list of token balances. It also contains a list of retailers located in Zuidhorn that can receive tokens. When a token is spend by a citizen of Zuidhorn, euro's are transferred to the retailer via a bunq API connection.
| 0.1.0 | Organisational decentralisation | The next step is to build a platform with four decentralized roles: sponsor, provider, requester and validator. The main goal is to make the barrier for any party to fulfilling one or more of the roles as low as possible. On the technical side the application is still mostly traditional. The platform is built on top of a PHP/MySQL stack. It currently uses a private ethereum node and a private IPFS node to research decentralizing even further. <br><br> Open source development on the first version of forus started on 1 june 2018. With lessons learned from our proof of concept, this version is meant to be more scalable, modulair, upgradable and extensible. While the main focus of this platform is to provide real value to end users, we are also using it to work towards our vision of full decentralisation. 
| 1.0.0 | Technical decentralisation | The final vision of forus will be a fully decentralized system where users can create funds, set criteria for who is eligible to recieve the funds, and for those people to apply for funds without interference of any centralized party (including [Foundation Forus](\../readme/foundation/README.md)). Reaching this vision will take time and resources, but we are set on achieving it.

### Organisational decentralisation

We are working together with our partners to extend and test the functionality of Forus step by step, making it more useful in every iteration. The roadmap below is meant to give an overview of planned features.

| Aim Date | Sponsor | Validator | Provider | Requester |
| --- | --- | --- | --- | --- |
| 1 Sept | There will be one fund (kindpakket) with criteria set by the municipality of Zuidhorn.  | Zuidhorn will use a CSV Upload tool to select the target audience and generate vouchers/activation codes. | Shopkeepers can register, apply to the fund and do special offers. | The requester will recieve an activation code for their voucher. |
| 1 Jan | The barrier to sponsorship (opening and connecting a bunq account) will be removed and it should be possible for anybody to sponsor a fund. | Zuidhorn becomes westerkwartier, where DigiD will be an identity validator trough Forus. | It becomes possible to add funds to a level more concrete then funds e.g. sponsoring the catagory sports within kindpakket. | Requesters can apply based on their personal records.

### Technical decentralisation

The vision of Forus is to be technically decentralized. This means the core interactions between the four actors in the platform are not performed on the infrastructure of Foundation Forus anymore, but on a decentralized backend / blockchain. This ensures that there is not a central party taxing or influencing this interaction.

To reach the milestone of full technical decentralisation is a long road that is currently inhabited by:

* Transaction volume / costs
* Privacy

We are constantly doing R&D to learn what the status of decentralized technology is and to see if we can make real steps into technically decentralizing the system.

