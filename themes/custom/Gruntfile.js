module.exports = function (grunt) {

	require('load-grunt-tasks')(grunt);

	// Configure, initConfig takes an object.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		babel: {
			options: {
				sourceMap: true,
				presets: ['es2015']
			},
			dist: {
				files: {
					'assets/js/custom.js': 'assets/js/custom.js' // Destination : Source.
				}
			}
		},

		browserSync: {
			dev: {
                bsFiles: {
                    src : [
                        'assets/scss/*.css',
                        '**/*.php'
                    ]
                },
                options: {
                    watchTask: true,
	                proxy: 'custom.dev'
                },
            }
		},

		concat: {
			options: {
				seperator: ';',
				//banner: '/* Blade Custom Theme close comment */\n'
			},
			target: {
				src: [ // We could do 'js/*.js' but the array allows us to select what we want
					// Foundation
					'bower_components/foundation-sites/js/foundation.core.js',
					// 'bower_components/foundation-sites/js/foundation.abide.js',
					'bower_components/foundation-sites/js/foundation.accordion.js',
					// 'bower_components/foundation-sites/js/foundation.accordionMenu.js',
					// 'bower_components/foundation-sites/js/foundation.core.js',
					// 'bower_components/foundation-sites/js/foundation.drilldown.js',
					// 'bower_components/foundation-sites/js/foundation.dropdown.js',
					// 'bower_components/foundation-sites/js/foundation.dropdownMenu.js',
					'bower_components/foundation-sites/js/foundation.equalizer.js',
					// 'bower_components/foundation-sites/js/foundation.interchange.js',
					// 'bower_components/foundation-sites/js/foundation.magellan.js',
					// 'bower_components/foundation-sites/js/foundation.offcanvas.js',
					// 'bower_components/foundation-sites/js/foundation.orbit.js',
					// 'bower_components/foundation-sites/js/foundation.responsiveMenu.js',
					// 'bower_components/foundation-sites/js/foundation.responsiveToggle.js',
					// 'bower_components/foundation-sites/js/foundation.reveal.js',
					// 'bower_components/foundation-sites/js/foundation.slider.js',
					// 'bower_components/foundation-sites/js/foundation.sticky.js',
					'bower_components/foundation-sites/js/foundation.tabs.js',
					// 'bower_components/foundation-sites/js/foundation.toggler.js',
					// 'bower_components/foundation-sites/js/foundation.tooltip.js',
					'bower_components/foundation-sites/js/foundation.util.box.js',
					'bower_components/foundation-sites/js/foundation.util.keyboard.js',
					'bower_components/foundation-sites/js/foundation.util.mediaQuery.js',
					'bower_components/foundation-sites/js/foundation.util.motion.js',
					'bower_components/foundation-sites/js/foundation.util.nest.js',
					'bower_components/foundation-sites/js/foundation.util.timerAndImageLoader.js',
					'bower_components/foundation-sites/js/foundation.util.touch.js',
					'bower_components/foundation-sites/js/foundation.util.triggers.js',
					// Slick
					'bower_components/slick-carousel/slick/slick.min.js',
					// Custom
					'assets/js/scripts/*.js'
				],
				dest: 'assets/js/custom.js'
			}
		},

		// http://gruntjs.com/configuring-tasks#building-the-files-object-dynamically
		copy: {
			fa: {
				files: [
					{
						expand: true,
						cwd: 'bower_components/font-awesome/fonts/',
						src: ['*'],
						dest: 'assets/fonts/'
					},
					{
						expand: true,
						cwd: 'bower_components/font-awesome/scss/',
						src: ['*', '!font-awesome.scss'],
						dest: 'assets/scss/fa/'
					}
				]
			},
			foundation: {
				files: [
					{
						expand: true,
						cwd: 'bower_components/foundation-sites/scss/',
						src: ['_global.scss', 'foundation.scss'],
						dest: 'assets/scss/foundation-sites'
					}
				]
			},
			slick: {
				files: [
					{
						expand: true,
						cwd: 'bower_components/slick-carousel/slick/fonts/',
						src: ['*'],
						dest: 'assets/fonts/'
					},
					{
						expand: true,
						cwd: 'bower_components/slick-carousel/slick/',
						src: ['slick-theme.scss', 'slick.scss'],
						dest: 'assets/scss/',
						rename: function(dest, src) {
							for ( var i = 0; i < src.length; i++ ) {
								return dest + src.replace(src[i], '_' + src[i]);
							}
						}
					}
				]
			}
		},

		sass: {
			target: {
				options: {
					style: 'compressed',
					sourcemap: 'file'
				},

				files: {
					'assets/scss/custom.css': 'assets/scss/custom.scss' // 'Destination': 'Source'
				}
			}
		},

		uglify: {
			options: {
				//mangle: true, // Shorten variable names
				compress: true,
				sourceMap: true,
				banner: '/* <%= pkg.author %> | <%= pkg.license %> | <%= grunt.template.today("mm-dd-yyyy") %> */\n'
			},
			target: { // We can name this whatever we like, example distribution or dist
				src: 'assets/js/custom.js', // Uncompressed
				dest: 'assets/js/custom.js' // Where to compress and output
			}
		},

		watch: {
			scripts: {
				files: ['assets/js/scripts/*.js'],
				tasks: ['concat', 'babel', 'uglify']
			},

			styles: {
				files: ['assets/scss/**/*.scss'],
				tasks: ['sass', 'postcss']
			}
		},

		postcss: {
			options: {
				map: true,
				processors: [
					require('autoprefixer')({browsers: 'last 2 versions'})
				]
			},

			dist: {
				src: 'assets/scss/*.css'
			}
		}

	});

	// Load the plugin
	grunt.loadNpmTasks('grunt-browser-sync');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-postcss');

	// Default runs when we call grunt on the command line
	// We can use any name we want to run specific tasks
	// The array is the order in which tasks are executed.
	grunt.registerTask('default', ['browserSync', 'watch']);

	//grunt.registerTask('default', ['jshint', 'concat', 'uglify']); // This runs when we type grunt on the command line. Then the array runs the tasks in order first to last
};
