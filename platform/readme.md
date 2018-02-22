# Demo
### v0.8

### Assignee: Martijn Doornik

## Goal
The goal of the demo is to show the way the decentralized platform would operate, showing 
new people the way blockchain development goes. 

## Status

The contracts are currently being developed. As of version 0.4, a working version is active, awaiting bugs and improvements.

## Execution

This demo is an Ethereum blockchain demo. You can run it on a Geth network or a TestRPC 
network (see Research and Development Wiki)

Only three contracts have to be deployed and in the following order: StringHelper, IdentityManager and 
PlatformForus. 

Users use the platform via the Identity (_i_) contract and will be assigned to four 
roles: Validators _v_, Requesters _r_, Sponsors _s_ and Providers _p_ but are not 
restricted to only one. 

_s_ can grant funds of token _t_ to _r_, based on a group of conditions. _p_ can provide eiter
service _q_ or asset _a_. _s_ is a replenischable product, whereas _a_ is unique and only exists once. 

### Step 0: requirements

- Every _i_ should add the PlatformForus script to their trusted application (addPermission).

### Step 1: validating a user

- _v_ can validate _i_ via the "vote" contract method. 

### Step 2: sponsoring a token

- Any _i_ can become _p_ by creating a token _t_ to the network. This is done by adding 
_t_ via the PlatformForus "addToken" method, triggering event "TokenAdded". 

### Step 3: providing a service or asset

- _s_ can select any _i_ to be _p_ (including himself) via the PlatformForus "addProvider"
 method

- _p_ can add a new _a_ or _q_ via the PlatformForus "createAsset" or "createService" methods,
respectively

- _p_ can set the value of _t_ to _a_ or _q_ via the "setAssetPrice" or "setServicePrice" methods,
respectively

- _q_ can have its supply increased or set via the PlatformForus 
"addAvailabilityToService" or "setAvailabilityOfService" methods, respectively. 

### Step 4: requesting a token

- _r_ can request a token via the PlatformForus "requestFund" method, provided that
_r_ meets condition _ct_, triggering event "TokenGranted".

### Step 5: requesting a service or asset

- _r_ can request _a_ or _q_ via the PlatformForus "purchaseAsset" or "purchaseService" methods, respectively, provided that 
_r_ meets condition _ca_, triggering event "AssetPurchased" or "ServicePurchased". 

- When _a_ or _q_ is handed out, _t_ is transferred to a special wallet bound to _p_.

- _s_ can reclaim _t_, which will trigger event "TokenReturned"

### Conditions

_ca_

_ct_