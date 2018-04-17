# forus.io mvp

Below you see wireframes for forus.io, where core functionality is implemented. Custom functionality is added trough [extentions](README.md#architecture).

**note:** work in progress

## 1.1 Main page without funds
![forus io - mvp-1](https://user-images.githubusercontent.com/30194799/38660051-31ed2ed6-3e2c-11e8-9807-1fc23e8a8167.png)

On the above image we see the webshop without any funds, by clicking the plus button a sponsor can add a new product/service.

## 2.1 Modal popup for new fund
![forus io - mvp-2](https://user-images.githubusercontent.com/30194799/38872046-a080c144-4252-11e8-9591-ecbc6a7f91b5.png)

After clicking the add button, a sponsor is asked to fill in the details and to add funds by sending them to the address behind the QR-code.

Here we see what the screen looks like when it is filled in:  
![forus io - mvp-5](https://user-images.githubusercontent.com/30194799/38660171-98e11238-3e2c-11e8-9a9f-f92ae425e5dd.png)

We could also offer a specific product (category): 
![forus io - mvp-4](https://user-images.githubusercontent.com/30194799/38660192-af350f62-3e2c-11e8-9cf6-f3e204de2689.png)


## Webshop with bike fund
![forus io - mvp-2](https://user-images.githubusercontent.com/30194799/38660275-f47caa3a-3e2c-11e8-8c42-814e9abe1a65.png)  
After adding the fund it is placed in the webshop. A user can now request it.

## Requesting the bike fund modal
![forus io - mvp-6](https://user-images.githubusercontent.com/30194799/38660309-136ee214-3e2d-11e8-9ac8-0ea6f37500e4.png)  
After the product is requested, the records of the user are checked with the criteria of the fund. If they match, the user is granted the funds. If they don't match, the user is asked to gather additional validations.

## After adding validations for the bike fund
![forus io - mvp-7](https://user-images.githubusercontent.com/30194799/38660350-31a7ffd6-3e2d-11e8-9522-ac7daeb3d608.png)  
The user has now added the validations to their records, this means that they can now buy a bike with one of the providers. At this screen they will learn about the providers that can deliver their bikes.



### Some additional ui/ux notes:
![1 shop](https://user-images.githubusercontent.com/30194799/37429628-32aa7b70-27d0-11e8-8e28-c7f6d83dd2cc.png)  

When performing a search the offers should re-arrange like [etherian.world](https://etherian.world). Products/services can be grouped/catagorized as proposed in [this image](https://user-images.githubusercontent.com/30194799/37451861-378892fe-2833-11e8-9894-ced81ed4710a.png), it could support multiple levels of nesting e.g. bike > female > brand > model in a flexible way. A very cool feature would be to sort the offers based on the records of the user (of course  privacy is a big concern here, therefore maybe the processing could happen on device), also  provider and product/service ratings could offer input for sorting the offers. 
