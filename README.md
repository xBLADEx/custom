![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/xbladex/custom)
![Node version (lts)](https://img.shields.io/badge/node-14.15.4-brightgreen)
![NPM version (npm)](https://img.shields.io/badge/npm-6.14.10-red)
[![Commitizen friendly](https://img.shields.io/badge/commitizen-friendly-brightgreen.svg)](http://commitizen.github.io/cz-cli/)
[![semantic-release](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantic--release-e10079.svg)](https://github.com/semantic-release/semantic-release)
[![Maintained](https://img.shields.io/badge/maintained_by-Rich_Edmunds-blue)](https://www.richedmunds.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

# Custom WordPress Theme

## Development

To develop with this theme you will need to install the following:

- [node](https://nodejs.org/)
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
- Uncomment slider sizes in functions > media-custom.php.

## Required Plugins

- [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) - Required for `<title>` tag and breadcrumbs.
- [ACF PRO](https://www.advancedcustomfields.com/pro/) - Required for page sub header and customization.

## reCAPTCHA v3

- [reCAPTCHA](https://www.google.com/recaptcha) - Required for custom form. Add keys to functions.php and google-recaptcha.js.
