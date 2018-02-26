// private info that will be added to the identity of the user

## Validate

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


