module.exports = {
	options: {
		keepSpecialComments: 0
	},
  combine: {
    files: {
      'css/build/minified/sass.css': ['css/build/prefixed/sass.css']
    }
  }
};
