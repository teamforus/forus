[![join chat](https://img.shields.io/badge/join%19chat-me-green.svg)](https://chat.forus.io/channel/me)

Maintainer | [@jknnr](https://github.com/jknnr)
--- | ---

# me: an app for managing identity, assets and records  

## why build me?
The average user on the internet has 90 accounts on the internet. That is because every application (roughly) has an application layer (what you see e.g. the website) an identity layer (your username/password) and a data layer. 

<img width="125" alt="screen shot 2018-06-20 at 12 53 54" src="https://user-images.githubusercontent.com/30194799/41654223-0bc43838-7489-11e8-93f0-a9663ca924b5.png">

All of this is owned and operated by the owner of the platform you are using.

The landscape of applications is fragmented, and therefore we, as users have to maintain all our accounts on the internet.

<img width="644" alt="screen shot 2018-06-20 at 12 55 04" src="https://user-images.githubusercontent.com/30194799/41654264-2ce35a30-7489-11e8-8843-1f2567875c9f.png">

We currently see apllications appear that are building very big identity layers (e.g. social networks) that allow us to log in on other aplications using their identity. This may provide user experience benifits but increases the amount of trust we have to place in the centralized parties.

By using new technologies it might be possible to change this whole model. Your data and assets can be stored in a decentralized infrastructure. Only you, by holding your keys (identity) have control over the (encrypted) data, instead of trusted third parties we now rely on. The management of these keys, is the purpose of the application in this repository.

<img width="673" alt="screen shot 2018-06-20 at 12 59 11" src="https://user-images.githubusercontent.com/30194799/41654441-c775828a-7489-11e8-97a9-cff49e6a4fa4.png">

## Functionality

The me app will support three main groups of functionality: a wallet for the things you own, your personal records and a way to identify and interact with third parties (applications, people or organisations)

<img width="537" alt="screen shot 2018-06-20 at 13 18 23" src="https://user-images.githubusercontent.com/30194799/41655199-71a66c18-748c-11e8-81ff-2d49e51175f1.png">

### 1. Wallet

Here are the things that hold economic value and are exchangable by the user.

### 2. Records

Records in this context are things that say something about you, but that hold no direct economic value and are not exchangable. E.g. your marks at school / your blood type / who are your parents.

### 3. Identity

By using the QR code scanner you can: 

* Log in to DAPPs / expose your identity
* Exchange value: image 1.1 is an example of the screen after scanning a voucher.
* Validate information (properties) image 1.2 is an example of the screen after scanning a validation request as in image 2.1.

## Roadmap

| # | Title | Discription |
| --- | --- | --- |
| 0.0.0 | Demo | During a feasibiltiy study we worked on for the Dutch [RVO](https://english.rvo.nl) we created a vision for a self sovereign identity solution that would be user friendly, based on standards, and fitting the needs of forus and other applications. <br> <br> At a field lab hackathon for the [association of dutch municipalities](https://vng.nl) we created a demo identity application, called the me app. Based on the concepts we had developed during the feasibility study.
| 0.1.0 | Digital identity | The first real-world application of the me app is currently being worked on. It is to be launched together with forus v0.1.0. Initialy the feature set will be focussed on providing the right funcionality to operate together with [kindpakket](). We will use it to learn how the application behaves in the real world, and use these lessons for future development. <br><br> The main focus is to learn how to provide maximum value to real-world users.
| 1.0.0 | Self sovereign identity | The full vision of the me app is to be a fully self-sovereign identity. Meaning that you own your data and keys, and there is no centralized party involved. Just like with forus this is a vision that required time and dedication

### Digital identity roadmap

| Aim Date | Identification | Wallet | Records |
| --- | --- | --- | --- |
| 1 Sept | Can log in to forus | Can have kindpakket voucher | POC: records for kindpakket ZH |
| 1 Jan |  | Ether in wallet | Validation dashboard for validators |
| 1 Apr |  | ERC721 support, land plots | p2p validations |

Wishlist:

| Identity | 
| --- |
| Login SDK / OAUTH |
| |
| |


### Self sovereign identity
To become a self sovereign identity, the technologies being researched are [ethereum](https://ethereum.org), [ipfs](https://ipfs.io). As our roadmap specifies, initially many parts of the me app will be working with centralized systems, build and maintained mainly by Foundation Forus, research is constantly being dong into further decentralisation. 

As much as possible, we are trying to implement open standards that are embraced by the community. e.g. [ERC20](docs/standards/ERC20.md) for tokens, [ERC721](docs/standards/ERC721.md) for assets, [ERC725](docs/standards/ERC725.md) for identity, [ERC735](docs/standards/ERC735.md) for claims. 

