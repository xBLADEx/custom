//--------------------------------------------------------------
// WEBPACK CONFIG
//
// @author Rich Edmunds
//--------------------------------------------------------------

const path = require('path'); // Needed for webpack to output path.
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin'); // Extract CSS into separate files.
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin'); // Copies individual files or entire directories to the build directory.
const proxy = 'custom.test';
const pathSource = './assets/source';
const pathDist = './assets/dist';

module.exports = (env, argv) => {
  const isProduction = 'production' === argv.mode; // Create boolean true if in production mode.

  return {
    entry: {
      custom: `${pathSource}/js/index.js`,
    },
    output: {
      filename: 'js/[name].js', // [name] is generated from the object entry properties. Example output is custom.js because entry.custom above.
      path: path.resolve(__dirname, `${pathDist}`),
    },
    module: {
      // https://webpack.js.org/loaders/
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: [
            {
              loader: 'babel-loader', // https://webpack.js.org/loaders/babel-loader/, https://github.com/babel/babel-loader
              options: {
                presets: [
                  [
                    '@babel/preset-env',
                    {
                      useBuiltIns: 'usage',
                      corejs: '3.0',
                    },
                  ],
                ], // https://babeljs.io/docs/en/babel-preset-env#options
              },
            },
          ],
        },
        {
          test: /\.(scss|css)$/,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: 'css-loader', // https://webpack.js.org/loaders/css-loader/
              options: {
                sourceMap: !isProduction,
                importLoaders: 1, // 0 => no loaders (default); 1 => postcss-loader; 2 => postcss-loader, sass-loader
                url: false,
              },
            },
            {
              loader: 'postcss-loader', // https://webpack.js.org/loaders/postcss-loader/
              options: {
                sourceMap: !isProduction,
              },
            },
            {
              loader: 'sass-loader',
              options: {
                // https://github.com/webpack-contrib/sass-loader#object
                implementation: require('sass'),
                sassOptions: {
                  sourceMap: !isProduction, // https://github.com/webpack-contrib/sass-loader#source-maps
                  outputStyle: 'compressed', // https://github.com/sass/dart-sass#javascript-api
                },
              },
            },
          ],
        },
        {
          test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/, // Fonts
          use: [
            {
              loader: 'file-loader', // https://webpack.js.org/loaders/file-loader/
              options: {
                name: 'fonts/[name].[ext]',
              },
            },
          ],
          include: [
            // https://webpack.js.org/configuration/module/#condition. Only include .svg if in fonts folders.
            path.resolve(__dirname, `${pathSource}/fonts`),
          ],
        },
        {
          test: /\.(png|jpg|gif|svg)$/, // Images
          use: [
            {
              loader: 'file-loader', // https://webpack.js.org/loaders/file-loader/
              options: {
                name: 'images/[name].[ext]',
              },
            },
          ],
          exclude: [
            // https://webpack.js.org/configuration/module/#condition. Exclude .svg files if in fonts folders.
            path.resolve(__dirname, `${pathSource}/fonts`),
          ],
        },
      ],
    },
    devtool: isProduction ? false : 'inline-source-map',
    externals: {
      // https://webpack.js.org/configuration/externals/
      jquery: 'jQuery', // Exclude jQuery from the final output file, rely on WordPress enqueue jQuery from Google CDN.
    },
    plugins: [
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
      }),
      new MiniCssExtractPlugin({ filename: 'css/[name].css' }), // https://github.com/webpack-contrib/mini-css-extract-plugin
      new BrowserSyncPlugin(
        {
          proxy: `https://${proxy}`,
          host: 'localhost',
          port: 3000,
          https: {
            key: `${pathSource}/ssl/localhost.key`,
            cert: `${pathSource}/ssl/localhost.cert`,
          },
          files: [`${pathSource}/js/*.js`, `${pathDist}/css/*.css`, '**/*.php'],
        },
        { injectCss: true, reload: false }
      ),
      // https://www.npmjs.com/package/copy-webpack-plugin
      new CopyWebpackPlugin({
        patterns: [
          {
            from: `${pathSource}/images`,
            to: 'images',
          },
          // {
          // 	from: `${pathSource}/fonts`,
          // 	to: 'fonts',
          // },
        ],
      }),
    ],
  };
};
