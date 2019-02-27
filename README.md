# Custom WordPress Theme

- Author: Rich Edmunds
- NPM: `6.4.1`
- Node: `10.11.0`
- Theme: `git clone git@github.com:xBLADEx/custom.git`

## Development
To develop with this theme you will need to install the following:

- [node](https://nodejs.org/download/release/v10.11.0/)
- `npm i -g npm` - Install the latest npm version globally.

In the theme folder the following commands are available:

- `npm install` - Install the packages.
- `npm run build` - Compile CSS and JS with sourcemaps.
- `npm run prod` - Compile CSS and JS without sourcemaps.
- `npm run watch` - Continuous compiling. Runs [Browsersync](https://www.browsersync.io/docs) in the browser.

## Slick Slider
To enable:
- Uncomment fonts path in CopyWebpackPlugin.
- Uncomment imports in vendor > index.scss.
- Uncomment slick-slider in js > index.js.

## Required Plugins
- [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) - Required for `<title>` tag and breadcrumbs.
- [ACF PRO](https://www.advancedcustomfields.com/pro/) - Required for page sub header and customization.
