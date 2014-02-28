module.exports = function(grunt) {
 
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);
 
    grunt.initConfig({

        uglify: {
			build: {
		        files: {
		            'js/main.min.js': [
		                'js/main.js'
		            ],
					'js/load.min.js': [
						'js/load.js'
					]
		        }
			}
        },

		cssmin: {
			build: {
				files: {
					'style.min.css': [
						'style.css'
					]
				}
			}
		}
 
    });

	grunt.registerTask('build', [
		'uglify:build',
		'cssmin:build'
	]);
	
	grunt.registerTask('default', ['build']);
 
};
