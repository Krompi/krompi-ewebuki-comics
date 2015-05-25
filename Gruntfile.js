module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            dist: {
                src: [
                    'js/custom/concat/*.js'
                ],
                dest: 'js/custom/production.js',
            }
        },

        uglify: {
            build: {
                src: 'js/custom/production.js',
                dest: 'js/custom/production.min.js'
            }
        },

        sass: {
            dist: {
                 options: {
                     style: 'expanded'
                 },
                // files: {
                //     'css/build/global.css': 'css/global.scss'
                // }
                files: [{
                    expand: true,
                    cwd: 'css/custom/scss',
                    src: ['*.scss'],
                    dest: 'css/custom/css',
                    ext: '.css'
                }]
            } 
        },

        cssmin: {
          minify: {
            expand: true,
            cwd: 'css/custom/css/',
            src: ['*.css', '!*.min.css'],
            dest: 'css/custom/css-min/',
            ext: '.css'
          }
        },

        watch: {
            options: {
                livereload: true,
            },
            scripts: {
                files: ['js/custom/concat/*.js'],
                tasks: ['concat', 'uglify'],
                options: {
                    spawn: false,
                },
            },
            css: {
                files: ['css/custom/scss/*.scss',
                        'css/custom/scss/**/*.scss'
                       ],
                tasks: ['sass'],
                options: {
                    spawn: false,
                },
            },
            cssmin: {
                files: ['css/custom/css/*'],
                tasks: ['cssmin'],
                options: {
                    spawn: false,
                },
            } 
        }

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['concat', 'uglify','sass','cssmin','watch']);

};
