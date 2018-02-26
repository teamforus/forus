**Note:** What follows below is a rough and incomplete draft. It tries to minimise the amount of end-points and focus on the core "low level" interactions. To allow for more flexibility, abstractions will happen at the client/front-end. Later, we might offer SDK's to help developers with this.

# Summary

This API facilitates the decentralized exchange of value if criteria are met.

### The main interaction:
**A fund** is a collection of resources, with attached criteria.
**A user** has certain properties.

**If** the *properties* of the user equal the *criteria* of the fund **then** transfer the resources to the user.

### The main functions:

To facilitate these interactions the protocol offers these 4 main functions:

**Sponsor:** Make resources available.
**Validate:** Confirm user properties.
**Request:** Apply for a resource from a fund.
**Provide:** Deliver the resource to the user.

The protocol assumes that a user has an "Identity" that holds properties and assets (https://github.com/teamforus/concept-identity).

# Sponsor
TBD, based on https://github.com/teamforus/concept-platform/issues/2

# Validate
INCOMPLETE, based on https://github.com/teamforus/concept-platform/issues/3

// private info that will be added to the identity of the user

**Path** /validate
**Method** POST
**Request Body**

````
{
user: public key
property: string
value: string
}
````
**Response Body** None
**Status Code** 200 -> success


## Get validation requests
Note: the identifier should be trustable.

**Path** /validate
**Method** GET
**Request Body** none
**Response Body**

````
public key {
identifier: string (bsn, etc.)
property: string
value: string
}
````
**Status Code** 200 -> success

# Request
TBD, based on https://github.com/teamforus/concept-platform/issues/4

# Provide
TBD, based on https://github.com/teamforus/concept-platform/issues/5
