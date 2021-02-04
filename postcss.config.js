// https://github.com/postcss/postcss-load-config#postcssrcjs-or-postcssconfigjs

module.exports = {
  plugins: {
    autoprefixer: {},
    cssnano: {
      zindex: false,
    },
    'css-mqpacker': {
      sort: true,
    },
  },
};
