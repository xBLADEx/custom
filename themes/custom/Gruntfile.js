module.exports = function( grunt ) {

	require( 'load-grunt-tasks' )( grunt );

	// Configure, initConfig accepts objects.
	grunt.initConfig({
		pkg: grunt.file.readJSON( 'package.json' ),

		babel: {
			options: {
				sourceMap: true,
				presets: [ 'es2015' ]
			},
			dist: {
				files: {
					'assets/js/custom.js': 'assets/js/custom-concat.js' // Destination : Source.
				}
			}
		},

		browserSync: {
			dev: {
				bsFiles: {
					src: [
						'assets/scss/*.css',
						'assets/js/custom.js',
						'**/*.php'
					]
				},
				options: {
					watchTask: true,
					proxy: 'custom.dev'
				}
			}
		},

		concat: {
			options: {
				seperator: ';'
			},
			target: {
				src: [ // We could do 'js/*.js' but the array allows us to select what we want.
					// Foundation.
					'assets/bower/foundation-sites/js/foundation.core.js',
					// 'assets/bower/foundation-sites/js/foundation.abide.js',
					'assets/bower/foundation-sites/js/foundation.accordion.js',
					// 'assets/bower/foundation-sites/js/foundation.accordionMenu.js',
					// 'assets/bower/foundation-sites/js/foundation.core.js',
					// 'assets/bower/foundation-sites/js/foundation.drilldown.js',
					// 'assets/bower/foundation-sites/js/foundation.dropdown.js',
					// 'assets/bower/foundation-sites/js/foundation.dropdownMenu.js',
					'assets/bower/foundation-sites/js/foundation.equalizer.js',
					// 'assets/bower/foundation-sites/js/foundation.interchange.js',
					// 'assets/bower/foundation-sites/js/foundation.magellan.js',
					// 'assets/bower/foundation-sites/js/foundation.offcanvas.js',
					// 'assets/bower/foundation-sites/js/foundation.orbit.js',
					// 'assets/bower/foundation-sites/js/foundation.responsiveMenu.js',
					// 'assets/bower/foundation-sites/js/foundation.responsiveToggle.js',
					// 'assets/bower/foundation-sites/js/foundation.reveal.js',
					// 'assets/bower/foundation-sites/js/foundation.slider.js',
					// 'assets/bower/foundation-sites/js/foundation.sticky.js',
					'assets/bower/foundation-sites/js/foundation.tabs.js',
					// 'assets/bower/foundation-sites/js/foundation.toggler.js',
					// 'assets/bower/foundation-sites/js/foundation.tooltip.js',
					'assets/bower/foundation-sites/js/foundation.util.box.js',
					'assets/bower/foundation-sites/js/foundation.util.keyboard.js',
					'assets/bower/foundation-sites/js/foundation.util.mediaQuery.js',
					'assets/bower/foundation-sites/js/foundation.util.motion.js',
					'assets/bower/foundation-sites/js/foundation.util.nest.js',
					'assets/bower/foundation-sites/js/foundation.util.timerAndImageLoader.js',
					'assets/bower/foundation-sites/js/foundation.util.touch.js',
					'assets/bower/foundation-sites/js/foundation.util.triggers.js',
					// 'assets/bower/foundation-sites/js/foundation.zf.responsiveAccordionTabs.js',

					// Slick.
					'assets/bower/slick-carousel/slick/slick.min.js',

					// Custom.
					'assets/js/scripts/*.js'
				],
				dest: 'assets/js/custom-concat.js'
			},
			loadcss: {
				src: [ 'assets/bower/loadcss/src/loadCSS.js', 'assets/bower/loadcss/src/cssrelpreload.js' ],
				dest: 'assets/js/critical.js'
			}
		},

		// @see http://gruntjs.com/configuring-tasks#building-the-files-object-dynamically.
		// copy: {
		// 	taskname: {
		// 		files: [
		// 			{
		// 				expand: true,
		// 				cwd: 'assets/bower/path/',
		// 				src: [ 'file.js', 'another-file.js' ],
		// 				dest: 'assets/path'
		// 			}
		// 		]
		// 	}
		// },

		// @see https://www.npmjs.com/package/grunt-critical.
		// @see https://github.com/bezoerb/grunt-critical.
		// @see https://github.com/addyosmani/critical#options.
		critical: {
			home: { // We can name this anything, the page name makes sense.
				options: {
					base: './',
					css: [
						'assets/scss/custom.css'
					],
					dimensions: [ // Output will be minified using this.
						{
							width: 300,
							height: 200
						},
						{
							width: 600,
							height: 200
						},
						{
							width: 900,
							height: 500
						},
						{
							width: 1200,
							height: 500
						}
					]
				},
				src: 'http://custom.dev',
				dest: 'assets/scss/critical.css'
			}
		},

		postcss: {
			options: {
				map: false,
				processors: [
					require( 'autoprefixer' )({browsers: 'last 2 versions'})
				]
			},
			dist: {
				src: 'assets/scss/custom.css'
			}
		},

		// @see https://codex.wordpress.org/I18n_for_WordPress_Developers.
		// @see http://stephenharris.info/grunt-wordpress-development-iii-tasks-for-internationalisation/.
		// @see https://github.com/stephenharris/grunt-pot.
		// @see https://poedit.net/.
		// @see https://eichefam.net/2015/04/27/translation-fun/.
		pot: {
			options: {
				text_domain: 'custom', // Text domain. Produces my-text-domain.pot.
				dest: 'languages/', // Directory for .pot file.
				keywords: [ // WordPress localisation functions.
					'__:1',
					'_e:1',
					'_x:1,2c',
					'esc_html__:1',
					'esc_html_e:1',
					'esc_html_x:1,2c',
					'esc_attr__:1',
					'esc_attr_e:1',
					'esc_attr_x:1,2c',
					'_ex:1,2c',
					'_n:1,2',
					'_nx:1,2,4c',
					'_n_noop:1,2',
					'_nx_noop:1,2,3c'
				]
			},
			files: {
				src: [ '**/*.php', '!node_modules/**' ], // Parse all PHP files.
				expand: true
			}
		},

		sass: {
			options: {
				sourcemap: false,
				style: 'compressed'
			},
			dist: {
				files: {
					'assets/scss/custom.css': 'assets/scss/custom.scss' // 'Destination': 'Source'.
				}
			}
		},

		// sass: {
		// 	target: {
		// 		options: {
		// 			style: 'compressed',
		// 			sourcemap: 'file'
		// 		},
		// 		files: {
		// 			'assets/scss/custom.css': 'assets/scss/custom.scss' // 'Destination': 'Source'.
		// 		}
		// 	}
		// },

		uglify: {
			options: {
				compress: true,
				sourceMap: true,
				banner: '/* <%= pkg.author %> | <%= pkg.license %> | <%= grunt.template.today("mm-dd-yyyy") %> */\n'
			},
			target: { // We can name this whatever we like, example dist.
				src: 'assets/js/custom.js', // Uncompressed.
				dest: 'assets/js/custom.js' // Where to compress and output.
			},
			loadcss: {
				options: {
					sourceMap: false,
					banner: false
				},
				src: 'assets/js/critical.js', // Uncompressed.
				dest: 'assets/js/critical.js' // Where to compress and output.
			}
		},

		watch: {
			scripts: {
				files: [ 'assets/js/scripts/*.js' ],
				tasks: [ 'concat:target', 'babel', 'uglify:target' ]
			},
			styles: {
				files: [ 'assets/scss/**/*.scss' ],
				tasks: [ 'sass', 'postcss' ]
			}
		}
	});

	// Load the tasks.
	grunt.loadNpmTasks( 'grunt-browser-sync' );
	grunt.loadNpmTasks( 'grunt-contrib-concat' );
	// grunt.loadNpmTasks( 'grunt-contrib-copy' );
	// grunt.loadNpmTasks( 'grunt-contrib-sass' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-critical' );
	grunt.loadNpmTasks( 'grunt-postcss' );
	grunt.loadNpmTasks( 'grunt-pot' );

	// Default runs when we call grunt on the command line.
	// We can use any name we want to run specific tasks.
	// The array is the order in which tasks are executed.
	grunt.registerTask( 'default', [ 'browserSync', 'watch' ]);

	// Styles.
	grunt.registerTask( 'styles', [ 'sass', 'postcss' ]);

	// Scripts.
	grunt.registerTask( 'scripts', [ 'concat:target', 'babel', 'uglify:target' ]);

	// LoadCSS.
	grunt.registerTask( 'loadcss', [ 'concat:loadcss', 'uglify:loadcss' ]);
};
