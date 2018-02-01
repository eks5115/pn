const path = require('path');

module.exports = {
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/assets/js'),
      '#': path.resolve(__dirname, 'resources/assets/sass')
    }
  }
};