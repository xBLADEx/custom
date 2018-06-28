//--------------------------------------------------------------
// WEBPACK CONFIG
//
// @author Rich Edmunds
//--------------------------------------------------------------

const path = require('path'); // Needed for webpack to output path.
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin'); // Extract CSS into separate files.
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin'); // Copies individual files or entire directories to the build directory.
const proxy = 'custom.test';

module.exports = (env, argv) => {
	const isProduction = 'production' === argv.mode; // Create boolean true if in production mode.

	return {
		entry: {
			custom: './assets/source/js/index.js',
		},
		output: {
			filename: 'js/[name].js', // [name] is generated from the object entry properties. Example output is custom.js because entry.custom above.
			path: path.resolve(__dirname, 'assets/dist'),
		},
		module: {
			// @see https://webpack.js.org/loaders/
			rules: [
				{
					test: /\.js$/,
					use: [
						{
							loader: 'babel-loader', // @see https://webpack.js.org/loaders/babel-loader/, https://github.com/babel/babel-loader
							options: {
								// @see https://babeljs.io/docs/usage/api/#options.
								presets: ['babel-preset-env'], // @see https://babeljs.io/docs/plugins/.
							},
						},
					],
				},
				{
					test: /\.(scss|css)$/,
					use: [
						MiniCssExtractPlugin.loader,
						{
							loader: 'css-loader', // @see https://webpack.js.org/loaders/css-loader/
							options: {
								sourceMap: !isProduction,
								importLoaders: 1, // 0 => no loaders (default); 1 => postcss-loader; 2 => postcss-loader, sass-loader
								url: false,
							},
						},
						{
							loader: 'postcss-loader', // @see https://webpack.js.org/loaders/postcss-loader/.
							options: {
								sourceMap: !isProduction,
							},
						},
						{
							loader: 'sass-loader',
							options: {
								sourceMap: !isProduction, // @see https://github.com/webpack-contrib/sass-loader#source-maps
								outputStyle: 'compact', // @see https://github.com/sass/node-sass#outputstyle.
							},
						},
					],
				},
				{
					test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/, // Fonts
					use: [
						{
							loader: 'file-loader', // @see https://webpack.js.org/loaders/file-loader/
							options: {
								name: 'fonts/[name].[ext]',
							},
						},
					],
					include: [
						// @see https://webpack.js.org/configuration/module/#condition. Only include .svg if in fonts folders.
						path.resolve(__dirname, 'assets/source/fonts'),
					],
				},
				{
					test: /\.(png|jpg|gif|svg)$/, // Images
					use: [
						{
							loader: 'file-loader', // @see https://webpack.js.org/loaders/file-loader/
							options: {
								name: 'images/[name].[ext]',
							},
						},
					],
					exclude: [
						// @see https://webpack.js.org/configuration/module/#condition. Exclude .svg files if in fonts folders.
						path.resolve(__dirname, 'assets/source/fonts'),
					],
				},
			],
		},
		devtool: isProduction ? '' : 'inline-source-map',
		externals: {
			// @see https://webpack.js.org/configuration/externals/
			jquery: 'jQuery', // Exclude jQuery from the final output file, rely on WordPress enqueue jQuery from Google CDN.
		},
		plugins: [
			new webpack.ProvidePlugin({
				$: 'jquery',
				jQuery: 'jquery',
			}),
			new MiniCssExtractPlugin({ filename: 'css/[name].css' }), // @see https://github.com/webpack-contrib/mini-css-extract-plugin
			new UglifyJSPlugin({
				// @see https://www.npmjs.com/package/uglifyjs-webpack-plugin
				test: /\.js$/i,
				sourceMap: !isProduction,
			}),
			new BrowserSyncPlugin(
				{
					proxy: `https://${proxy}`,
					host: 'localhost',
					port: 3000,
					https: {
						key: './assets/source/ssl/localhost.key',
						cert: './assets/source/ssl/localhost.cert',
					},
					files: ['./assets/source/js/*.js', './assets/dist/css/*.css', '**/*.php'],
				},
				{ injectCss: true, reload: false }
			),
			new CopyWebpackPlugin([
				// @see https://www.npmjs.com/package/copy-webpack-plugin
				{
					from: 'assets/source/images',
					to: 'images',
				},
				{
					from: 'assets/source/fonts',
					to: 'fonts',
				},
			]),
		],
	};
};
