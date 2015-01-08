module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      build: {
        options: {
          beautify: true,
          mangle: false
        },
        files: {
          'js/build/main.min.js': ['js/jquery-1.11.1.js','js/libs/*.js', 'js/main.js']
        }
      }
    },
    imagemin: {
      dynamic: {
        files: [{
          expand: true,
          cwd: 'images/',
          src: ['**/*.{png,jpg,gif}'],
          dest: 'images/'
        }]
      }
    },
    sass: {
      dist: {
        options: {
          style: 'expanded',
          sourcemap: true,
        },
        files: {
          'css/main.css': 'sass/main.scss'
        }
      }
    },
    autoprefixer: {
      dist: {
        files: {
          'css/main.css': 'css/main.css'
        }
      }
    },
    svgmin: {
      dist: {
        files: [{
          expand: true,
          cwd: 'svgs/',
          src: ['*.svg'],
          dest: 'svgs/'
        }]
      },
      options: {
        plugins: [
            { removeViewBox: false },               // don't remove the viewbox atribute from the SVG
            { removeEmptyAttrs: false }             // don't remove Empty Attributes from the SVG
        ]
      }
    },
    svgstore: {
      dist: {
        files: {
          'svgs/build/svg-defs.svg': ['svgs/*.svg']
        },
      },
      options: {
        cleanup: true
      }
    },
    svg2png: {
      dist: {
        files: [{ 
          flatten: true,
          cwd: 'svgs/', 
          src: ['*.svg'], 
          dest: '../' }
        ]
      }
    },
    watch: {
      scripts: {
        files: ['js/libs/*.js', 'js/main.js'],
        tasks: ['uglify'],
        options: {
          livereload: true,
        },
      },
      images: {
        files: 'images/*.{png,jpg,gif}',
        tasks: ['imagemin'],
        options: {
          livereload: true,
        },
      },
      css: {
        files: '**/*.scss',
        tasks: ['sass', 'autoprefixer'],
        options: {
          livereload: true,
        },
      },
      svgs: {
        files: 'svgs/*.svg',
        tasks: ['svgmin', 'svgstore', 'svg2png'],
        options: {
          livereload: true,
        },
      }
    },
  });

  require('load-grunt-tasks')(grunt);
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-svgmin');
  grunt.loadNpmTasks('grunt-svgstore');
  grunt.loadNpmTasks('grunt-svg2png');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task(s).
  grunt.registerTask('default', ['watch']);

};