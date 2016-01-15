module.exports = {
  dist: {
    options: {
      // cssmin will minify later
      style: 'expanded'
    },
    files: {
      'css/build/sass.css': 'sass/style.scss'
    }
  }
};
