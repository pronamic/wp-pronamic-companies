module.exports = function( grunt ) {
	// Project configuration
	grunt.initConfig( {
		// Package
		pkg: grunt.file.readJSON( 'package.json' ),

		dirs: {
			ignore: [ 'bower_components', 'deploy', 'node_modules' ].join( ',' ) 
		},

		// PHP Code Sniffer
		phpcs: {
			application: {
				src: [
					'**/*.php',
					'!bower_components/**',
					'!deploy/**',
					'!node_modules/**'
				],
			},
			options: {
				standard: 'phpcs.ruleset.xml',
				showSniffCodes: true
			}
		},

		// PHPLint
		phplint: {
			options: {
				phpArgs: {
					'-lf': null
				}
			},
			all: [ '**/*.php' ]
		},

		// PHP Mess Detector
		phpmd: {
			application: {
				dir: '.'
			},
			options: {
				exclude: '<%= dirs.ignore %>',
				reportFormat: 'text',
				rulesets: 'phpmd.ruleset.xml'
			}
		},
		
		// Check WordPress version
		checkwpversion: {
			options: {
				readme: 'readme.txt',
				plugin: 'pronamic-companies.php',
			},
			check: {
				version1: 'plugin',
				version2: 'readme',
				compare: '=='
			},
			check2: {
				version1: 'plugin',
				version2: '<%= pkg.version %>',
				compare: '=='
			}
		},

		// Check textdomain errors
		checktextdomain: {
			options:{
				text_domain: 'pronamic_companies',
				keywords: [
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d'
				]
			},
			files: {
				src:  [
					'**/*.php',
					'!bower_components/**',
					'!examples/**',
					'!deploy/**',
					'!node_modules/**'
				],
				expand: true
			}
		},
		
		// MakePOT
		makepot: {
			target: {
				options: {
					domainPath: 'languages',
					type: 'wp-plugin',
					updatePoFiles: true,
					exclude: [
						'bower_components/.*',
						'deploy/.*',
						'examples/.*',
						'node_modules/.*'
					],
				}
			}
		},
		
		// Copy
		copy: {
			deploy: {
				src: [
					'**',
					'!bower.json',
					'!composer.json',
					'!Gruntfile.js',
					'!package.json',
					'!phpcs.ruleset.xml',
					'!phpmd.ruleset.xml',
					'!bower_components/**',
					'!deploy/**',
					'!node_modules/**'
				],
				dest: 'deploy/latest',
				expand: true
			},
		},

		// Clean
		clean: {
			deploy: {
				src: [ 'deploy/latest' ]
			},
		},

		// Compress
		compress: {
			deploy: {
				options: {
					archive: 'deploy/archives/<%= pkg.name %>.<%= pkg.version %>.zip'
				},
				expand: true,
				cwd: 'deploy/latest',
				src: ['**/*'],
				dest: '<%= pkg.name %>/'
			}
		},

		// Git checkout
		gitcheckout: {
			tag: {
				options: {
					branch: 'tags/<%= pkg.version %>'
				}
			},
			develop: {
				options: {
					branch: 'develop'
				}
			}
		},

		// S3
		aws_s3: {
			options: {
				region: 'eu-central-1'
			},
			deploy: {
				options: {
					bucket: 'downloads.pronamic.eu',
					differential: true
				},
				files: [
					{
						expand: true,
						cwd: 'deploy/archives/',
						src: '<%= pkg.name %>.<%= pkg.version %>.zip',
						dest: 'plugins/<%= pkg.name %>/'
					}
				]
			}
		},

		// WordPress deploy
		rt_wp_deploy: {
			app: {
				options: {
					svnUrl: 'http://plugins.svn.wordpress.org/<%= pkg.name %>/',
					svnDir: 'deploy/wp-svn',
					svnUsername: 'pronamic',
					deployDir: 'deploy/latest',
					version: '<%= pkg.version %>',
				}
			}
		},
	} );

	grunt.loadNpmTasks( 'grunt-phpcs' );
	grunt.loadNpmTasks( 'grunt-phplint' );
	grunt.loadNpmTasks( 'grunt-phpmd' );
	grunt.loadNpmTasks( 'grunt-checkwpversion' );
	grunt.loadNpmTasks( 'grunt-checktextdomain' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-contrib-concat' );
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.loadNpmTasks( 'grunt-git' );
	grunt.loadNpmTasks( 'grunt-aws-s3' );
	grunt.loadNpmTasks( 'grunt-rt-wp-deploy' );

	// Default task(s).
	grunt.registerTask( 'default', [ 'phplint', 'phpmd', 'phpcs', 'checkwpversion' ] );
	grunt.registerTask( 'pot', [ 'checktextdomain', 'makepot' ] );
	
	grunt.registerTask( 'deploy', [
		'default',
		'clean:deploy',
		'copy:deploy',
		'compress:deploy'
	] );

	grunt.registerTask( 'wp-deploy', [
		'gitcheckout:tag',
		'deploy',
		'rt_wp_deploy',
		'gitcheckout:develop'
	] );

	grunt.registerTask( 's3-deploy', [
		'gitcheckout:tag',
		'deploy',
		'aws_s3:deploy',
		'gitcheckout:develop'
	] );
};
