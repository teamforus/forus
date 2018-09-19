# Contribution manual

So, you’ve decided you would like to contribute to the documentation? Great! You can follow the steps below to have your contributions show up on [docs.forus.io](https://docs.forus.io).

## Steps

### 1: Fork the docs
First go to [github.com/teamforus/docs](https://github.com/teamforus/docs) and click the fork button.

<img width="370" alt="screen shot 2018-08-14 at 10 07 28" src="https://user-images.githubusercontent.com/30194799/44079662-ef67193e-9fa9-11e8-9ccd-c997121af826.png">

You will now have a copy of the docs that you can freely edit.

### 2: Making changes
Please be sure to read the [markdown styleguide](\../markdown-styleguide/README.md).

#### 2a: Editing existing documents
Editing an existing document is quite simple. You can use the github interface to do it. When you open a file, you will see an edit button on the top right:

<img width="300" alt="screen shot 2018-08-14 at 10 17 40" src="https://user-images.githubusercontent.com/30194799/44080204-ab1f73fa-9fab-11e8-8edd-063ae905a94a.png">

When you are done editing, you can commit the changes on the bottom of the page:

<img width="931" alt="screen shot 2018-08-14 at 10 31 51" src="https://user-images.githubusercontent.com/30194799/44080756-4f1cc81c-9fad-11e8-91b0-02fa45f848ed.png">


#### 2b: Creating a new document
If you want to add a new file, you should create a folder with the name you want the file to have in the navigation structure. In that folder you should then create a file named README.md. 

e.g. me/standards/erc-20/README.md

After adding the file you can update the navigation structure located in [menu_settings/toc.yml](https://github.com/teamforus/docs/blob/develop/menu_settings/toc.yml)

### 3: Open a pull request

After you have made your contributions, you can create a pull request to teamforus/docs. Go to the pull requests tab and click new pull request:

<img width="990" alt="screen shot 2018-08-14 at 10 22 53" src="https://user-images.githubusercontent.com/30194799/44080490-77f5aec6-9fac-11e8-91ed-3f2ef2cabc7b.png">

As the base fork set teamforus/docs. If this is not possible, click "compare across forks"

<img width="840" alt="screen shot 2018-08-14 at 10 25 45" src="https://user-images.githubusercontent.com/30194799/44080543-a1c69c38-9fac-11e8-86e7-fe434c109d03.png">

Then click: "create pull request"

### 4: Processing feedback
Your changes will now be reviewed. If they are good they will be added to the documentation. If they still need work, you will recieve feedback on your pull request. You can process the feedback by going back to your fork, making and commiting the changes, your pull request will now automatically be updated with the new changes.
