module.exports = function (grunt) {

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  var pkg = grunt.file.readJSON('package.json');
  const sass = require('node-sass');

  grunt.initConfig({

    clean: {
      pkg: 'pkg',
    },

    // Copy asset files from NPM to the src folder. This should
    // be done after installing or updating asset packages.
    copy: {
      main: {
        files: [
          {
            expand: true,
            cwd: 'node_modules/bootstrap/dist/js',
            src: '**/*.js',
            dest: 'js/bootstrap4/'
          },
          {
            expand: true,
            cwd: 'node_modules/bootstrap/scss',
            src: '**/*.scss',
            dest: 'scss/bootstrap4/'
          },
          {
            expand: true,
            cwd: 'node_modules/font-awesome/fonts',
            src: '**/*.{ttf,woff,woff2,eot,svg}',
            dest: 'fonts'
          },
          {
            expand: true,
            cwd: 'node_modules/font-awesome/scss',
            src: '*.scss',
            dest: 'scss/font-awesome/'
          },
          {
            expand: true,
            cwd: 'node_modules/undescores-for-npm/sass/media',
            src: '*.scss',
            dest: 'scss/underscores/'
          },
          {
            expand: true,
            cwd: 'node_modules/undescores-for-npm/js',
            src: 'skip-link-focus-fix.js',
            dest: 'js'
          },
        ],
      },
    },

    sass: {
      options: {
        implementation: sass,
        sourceMap: true
      },
      dist: {
        files: {
          'css/theme.min.css': 'scss/theme.scss',
          'css/custom-editor-style.min.css': 'scss/custom-editor-style.scss'
        }
      }
    },

    uglify: {
      options: {
        mangle: false
      },
      main: {
        files: {
          'js/theme.min.js': [
            'js/bootstrap4/bootstrap.bundle.js',
            'js/skip-link-focus-fix.js',
            'js/custom-javascript.js',
          ]
        }
      }
    },

    watch: {
      payload: {
        files: ['scss/*.scss', 'js/custom-javascript.js'],
        tasks: 'build'
      }
    },

    compress: {

      dist: {
        options: {
          archive: 'pkg/ehri-wp-theme-' + pkg.version + '.zip'
        },
        dest: 'ehri',
        src: [

          '**',

          // GIT
          '!.git/**',

          // NPM
          '!package.json',
          '!package-lock.json',
          '!node_modules/**',

          // COMPOSER
          '!composer.json',
          '!composer.lock',
          '!vendor/**',

          // RUBY
          '!Gemfile',
          '!Gemfile.lock',

          // GRUNT
          '!.grunt/**',
          '!Gruntfile.js',

          // SASS
          '!.sass-cache/**',

          // DIST
          '!pkg/**',

          // Editor settings
          '!*.vim',
          '!.idea',
          '!*.iml',
        ]
      }

    }

  });

  // Clean
  grunt.registerTask('clean-src', 'cleansrc');

  // Watch sass and JS
  grunt.registerTask('default', 'watch');

  // Build the application.
  grunt.registerTask('build', [
    'clean',
    'sass',
    'uglify',
  ]);

  // Spawn release package.
  grunt.registerTask('package', [
    'build',
    'compress'
  ]);

};
