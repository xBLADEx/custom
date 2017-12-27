//--------------------------------------------------------------
// POSTCSS CONFIG
//
// Author: Rich Edmunds
// @see https://webpack.js.org/loaders/postcss-loader/#usage
// @see https://github.com/michael-ciniawsky/postcss-load-config
//--------------------------------------------------------------

module.exports = {
	plugins: {
		autoprefixer: {},
		cssnano: {},
		'css-mqpacker': {
			sort: true,
		},
	},
};
