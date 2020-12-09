# Based on [Sage 8](https://roots.io/sage/)

## Requirements

| Prerequisite    | How to check | How to install
| --------------- | ------------ | ------------- |
| Node.js 12  | `node -v`    | [nodejs.org](http://nodejs.org/) |
| gulp >= 4  | `gulp -v`    | `npm install -g gulp` |


## Theme installation

Bottom line is you want to get the files in this repo into your local development environment. There are many ways to do this, two of which we will cover here.

### via Command-line

If you're already [using Composer to manage WordPress](https://roots.io/using-composer-with-wordpress/), then you might consider using composer's `create-project` command to download Sage.

The example below assumes you're using Bedrock. If you're not, simply change the target path accordingly.

```sh
composer create-project roots/sage web/app/themes/your-theme-name-here
```

Then activate the theme via [wp-cli](http://wp-cli.org/commands/theme/activate/).

```sh
wp theme activate your-theme-name-here
```

## Theme setup

Edit `lib/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, post formats, and sidebars.

## Theme development

Pure-demo uses [gulp](http://gulpjs.com/) as its build system and [Parcel](https://parceljs.org/) to manage front-end packages.

### Install gulp and parcel

Building the theme requires [node.js](http://nodejs.org/download/). We recommend you update to the latest version of npm: `npm install -g npm@latest`.

From the command line:

1. Install [gulp](http://gulpjs.com) globally with `yarn global add gulp`
2. Navigate to the theme directory, then run `yarn install`

You now have all the necessary dependencies to run the build process.

### Available gulp commands

* `gulp` — Compile and optimize the files in your assets directory
* `gulp watch` — Compile assets when file changes are made
* `gulp --production` — Compile assets for production (no source maps).

### Using BrowserSync

To use BrowserSync during `gulp watch` you need to update `devUrl` at the bottom of `assets/manifest.json` to reflect your local development hostname.

For example, if your local development URL is `http://project-name.dev` you would update the file to read:
```json
...
  "config": {
    "devUrl": "http://project-name.dev"
  }
...
```
If your local development URL looks like `http://localhost:8888/project-name/` you would update the file to read:
```json
...
  "config": {
    "devUrl": "http://localhost:8888/project-name/"
  }
...
```

## Documentation

Sage documentation is available at [https://roots.io/sage/docs/](https://roots.io/sage/docs/).

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](CONTRIBUTING.md) to help you get started.

## Community

Keep track of development and community news.

* Participate on the [Roots Discourse](https://discourse.roots.io/)
* Follow [@rootswp on Twitter](https://twitter.com/rootswp)
* Read and subscribe to the [Roots Blog](https://roots.io/blog/)
* Subscribe to the [Roots Newsletter](https://roots.io/subscribe/)
