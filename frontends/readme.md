# Quick Dev Template
Set of tools called to help developers to develop their web applications faster, based on [gulp](http://gulpjs.com/).

## Includes libraries and frameworks
  - Bootstrap 3
  - AngularJS and AngularJS 2
  - jQuery
  - Underscore.js and Underscore.String.js 
  - Material Design Icons (by. Google)

## Gulp components
 - **List will be available, soon.** 

### Version
##### 0.1.6 => 0.2.0
- combine js/ts tasks  
- minify, sourcemap and browserify support for javascript  
- config and environment file .json => .js (module export, backward compatible)  
now supports comments and nodejs logic
- optionally disable scss minification
- removed 2 unused gulp plugins

##### 0.1.0
Description will be available soon.

##### 0.0.1
Description will be available soon.

### Installation

Quick Dev Template requires [Node.js](https://nodejs.org/) v4+ with [npm](https://www.npmjs.com) to run.

You need Gulp installed globally:

```sh
$ npm i -g gulp
```

Then you need to clone qdt repository.
```sh
$ git clone https://HardCoderNET@bitbucket.org/HardCoderNET/quick-dev-template.git [project-name]
```

Now open **dev/front** folder inside your project and install **npm** dependencies.
```sh
$ cd [project-name]/dev
$ npm i
```

To create environment file from sample run
```sh
$ gulp init
```

Then you should run gulp task **add-source**.
Default source name is "base", but you might change it in qdt-config.json in platforms > "*" > "source", or for specific platform to override global "source" value.
```sh
$ gulp source:add --name="base"
```

Now you can start working no your project using following commands:  

Run web server and watch files for changes 
```sh
$ gulp 
```
   
Compile source but don't start web server and don't watch files for changes
```
$ gulp compile
```

Run only web server but don't compile anything   
(make sure to have source code compiled, otherwise you will not see anything)
```
$ gulp server
```

Run web server and watch source code, but don't do full compile on start  
(only files modified after startup, will be compiled)
```
$ gulp watch
```

### Documentation
Documentation will be available later. 
For now, you may read comments from config and environment files.