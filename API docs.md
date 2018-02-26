# Summary
This API facilitates the decentralized exchange of value if criteria are met.

### The main interaction:
**An offer** is a product/service made to be available under attached criteria.  
**A user** has an [identity](https://github.com/teamforus/concept-identity) that holds properties and assets.

**If** the *properties* of the user equal the *criteria* of the offer **then** perform the transaction.

## Shop:
**Note:** work in progress

### api.forus.io/offer
To make something available for exchange when criteria are met.

body:

````
get
	get offers

post
	product/service
	quantity
	criteria
````

#### api.forus.io/offer/sponsor
Pay the provider when a requester meets criteria of an offer.

body:

````
post
	product/service
	criteria
	a signed transaction / proof of making the funds available
````

### api.forus.io/offer/provide
Providing entails a (physical) action like handing over an asset or providing a service. In return a provider gets paid by the customer or one or multiple sponsors, or if the requester meets other criteria put by the sponsor, no payment is performed.

### api.forus.io/request
Request a product or service from a provider.

body:

````
get
	receive the criteria

post
	proof of payment: signed transaction
	proof of properties: signed info
````

## app:
**note:** incomplete

### api.forus.io/properties

body:

````
get: 
	validation requests
	type: asset / record

post:
	address/key/value
	signed validation (optionally encrypted with public key)
````