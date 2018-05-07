module.exports = {
    platforms: {
        "*": {
            "source": "base",
            "libs": {
                // please disable libraries you don't need
                "jquery": true,
                "bootstrap_3": true,
                "angular": true,
                "angular_2": true,
                "underscore": true,
                "underscore.string": true,
                "mdi": true
            },
            "libs_data": {},
            // overwrite this paths in your platform
            "paths": {
                "root": false,
                "assets_root": false,
                "clean_paths": false
            },
            // add here libraries from node_modules
            "assets": [{
                "from": "resources/assets/**/*",
                "to": "assets"
            }],
            // browsersync configurations (ex: ip, port and path)
            "server": false,
            // tasks configs
            "tasks": {
                // disable tasks
                "disabled": {
                    "pug": false,
                    "js": false,
                    "assets": false
                },
                // tasks details, ex: source, destination, minify and etc. 
                "settings": {
                    "js": [{
                        "src": [
                            "angular-1/modules/**/*",
                            "angular-1/components/**/*",
                            "angular-1/controllers/**/*",
                            "angular-1/directives/**/*",
                            "angular-1/providers/**/*",
                            "angular-1/filters/**/*",
                            "app.ts",
                            "app.js"
                        ],
                        "dest": "/",
                        "name": "app.js",
                        "minify": false,
                        "sourcemap": false,
                        "browserify": true
                    }, {
                        "src": [
                            // "raw/**/*.js"
                        ],
                        "dest": "/raw",
                        "path": "/raw",
                        "minify": true,
                        "sourcemap": false,
                        "browserify": false
                    }],
                    "scss": [{
                        "src": "style.scss",
                        "watch": "includes/**/*.scss",
                        "path": "/",
                        "name": "style.min.css",
                        "minify": true
                    }],
                    "pug": [{
                        "path": "/",
                        "src": ["*.pug"],
                        "watch": ["layout/**/*.pug"],
                        "path": "/"
                    }, {
                        "path": "/raw/tpl",
                        "src": ["raw/**/*.pug"],
                        "path": "/tpl"
                    }]
                }
            }
        },
        "html": {
            "source": "base",
            "paths": {
                "root": "../html",
                "assets_root": "../html/assets",
                "clean_paths": [
                    "../html"
                ]
            },
            "server": {
                "path": "/",
                "port": 3000
            }
        },
        "html-panel": {
            "source": "base-panel",
            "paths": {
                "root": "../html-panel",
                "assets_root": "../html-panel/assets",
                "clean_paths": [
                    "../html-panel"
                ]
            },
            "server": {
                "path": "/",
                "port": 4000
            }
        },
        "phonegap": {
            "paths": {
                "root": "../phonegap/www",
                "assets_root": "../phonegap/www/assets",
                "clean_paths": [
                    "../phonegap/www"
                ]
            }
        },
        "php": {
            "paths": {
                "root": "../php/public",
                "assets_root": "../php/public/assets",
                "clean_paths": [
                    "../php/public/assets",
                    "../php/public/raw"
                ]
            },
            "tasks": {
                "settings": {
                    "pug": [{
                        "path": "/raw/tpl",
                        "src": ["raw/**/*.pug"],
                        "dest": "/tpl"
                    }]
                }
            }
        }
    }
};