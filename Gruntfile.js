module.exports = function(grunt) {

  // Utility to load the different option files
  // based on their names
  function loadConfig(path) {
    var glob = require('glob');
    var object = {};
    var key;

    glob.sync('*', {cwd: path}).forEach(function(option) {
      key = option.replace(/\.js$/,'');
      object[key] = require(path + option);
    });

    return object;
  }

  // Initial config
  var config = {
    pkg: grunt.file.readJSON('package.json')
  };

  // Load tasks from the tasks folder
  grunt.loadTasks('tasks');

  // Load all the tasks options in tasks/options base on the name:
  // watch.js => watch{}
  grunt.util._.extend(config, loadConfig('./tasks/options/'));

  grunt.initConfig(config);

  require('load-grunt-tasks')(grunt);

  // Default Task is very minimal
  grunt.registerTask('default', ['concat', 'uglify']);

  // There are separate build steps for JS and CSS, which can be combined
  grunt.registerTask('build-js', ['concat', 'uglify']);
  // grunt.registerTask('build-css', ['sass', 'autoprefixer', 'cssmin']);
  // grunt.registerTask('build', ['build-js', 'build-css']);

  // Moved to the tasks folder:
  // grunt.registerTask('dev', ['connect', 'watch']);

};