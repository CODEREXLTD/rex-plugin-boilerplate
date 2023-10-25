'use strict';
module.exports = function(grunt) {
	var pkg = grunt.file.readJSON('package.json');

	grunt.initConfig({
		addtextdomain: {
			options: {
				textdomain: 'the-plugin-name-text-domain'
			},
			update_all_domains: {
				options: {
					updateDomains: true
				},
				src: [
					'*.php',
					'**/*.php',
					'!node_modules/**',
					'src/**',
					'!php-tests/**',
					'!bin/**',
					'!build/**',
					'assets/**'
				]
			}
		},

		// Generate POT files.
		makepot: {
			target: {
				options: {
					exclude: [
						'build/.*',
						'node_modules/*',
						'tests/*',
						'bin/*'
					],
					mainFile: '{{the-plugin-name}}.php',
					domainPath: '/languages/',
					potFilename: 'plugin-name-text-domain.pot',
					type: 'wp-plugin',
					updateTimestamp: true,
					potHeaders: {
						'report-msgid-bugs-to': '{{plugin_url}}',
						'language-team': 'LANGUAGE <{{author_email}}>',
						poedit: true,
						'x-poedit-keywordslist': true
					}
				}
			}
		},

		// Clean up build directory
		clean: {
			main: ['build/']
		},

		// Copy the plugin into the build directory
		copy: {
			main: {
				src: [
					'**',
					'!node_modules/**',
					'!docs/**',
					'!build/**',
					'!bin/**',
					'!.git/**',
					'!Gruntfile.js',
					'!CONTRIBUTING.md',
					'!package.json',
					'!package-lock.json',
					'!composer.json',
					'!composer.lock',
					'!Readme.md',
					'!config.json',
					'!phpcs.xml.dist',
					'!vite.config.js',
					'!tailwind.config.js',
					'!postcss.config.js',
					'!debug.log',
					'!phpunit.xml',
					'!.gitignore',
					'!.gitmodules',
					'!docker-compose.yml',
					'!Dockerfile',
					'!phpunit.xml.dist',
					'!npm-debug.log',
					'!.deepsource.toml',
					'!.editorconfig',
					'!.env.testing',
					'!.eslintignore',
					'!.php_cs',
					'!appspec.yml.php',
					'!codeception.dist.yml',
					'!prettier.config.js',
					'!.eslintrc.js',
					'!sonar-project.properties',
					'!src/**',
					'!tests/**',
					'!**/Gruntfile.js',
					'!**/package.json',
					'!**/README.md',
					'!**/*~'
				],
				dest: 'build/'
			}
		},

		//Compress build directory into <name>.zip and <name>-<version>.zip
		compress: {
			main: {
				options: {
					mode: 'zip',
					archive: './build/checkoutify-v' + pkg.version + '.zip'
				},
				expand: true,
				cwd: 'build/',
				src: ['**/*'],
				dest: 'checkoutify'
			}
		},

		run: {
			options: {},
			build: {
				cmd: 'npm',
				args: ['run', 'production']
			},
			devBuild: {
				cmd: 'npm',
				args: ['run', 'development']
			},
			removeDev: {
				cmd: 'composer',
				args: ['install', '--no-dev', '--ignore-platform-reqs', '--optimize-autoloader']
			},

			dumpautoload: {
				cmd: 'composer',
				args: ['dumpautoload', '-o']
			},

			composerInstall: {
				cmd: 'composer',
				args: ['install']
			},
			makepot: {
				target: {
					options: {
						exclude: [
							'build/.*',
							'node_modules/*',
							'src/*',
							'tests/*',
							'bin/*'
						],
						mainFile: 'checkoutify.php',
						domainPath: '/languages/',
						potFilename: 'checkoutify.pot',
						type: 'wp-plugin',
						updateTimestamp: true,
						potHeaders: {
							'report-msgid-bugs-to': 'https://getwpfunnels.com/',
							'language-team': 'LANGUAGE <EMAIL@ADDRESS>',
							poedit: true,
							'x-poedit-keywordslist': true
						}
					}
				}
			},
		}
	});

	// Load NPM tasks to be used here

	grunt.loadNpmTasks('grunt-wpvue-i18n');
	grunt.loadNpmTasks('grunt-run');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-compress');

	// file auto generation
	grunt.registerTask('i18n', ['makepot']);
	grunt.registerTask('test', ['clean']);

	grunt.registerTask('release', [
		'run:removeDev',
		'run:dumpautoload',
		'clean',
		'run:build',
		'copy',
	]);

	grunt.registerTask('zip', [
		'compress',
	]);
};
