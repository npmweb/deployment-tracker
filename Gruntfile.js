/**
 * Creates symlinks for the multiple endpoints
 *
 * Requires npm, which is part of node.js <http://nodejs.org/>
 * To run:
 *   npm install
 *   grunt
 */
module.exports = function(grunt) {
  grunt.initConfig({
    custom_config: grunt.file.readJSON('.env.json'),
    pkg: grunt.file.readJSON('package.json'),
    paths: {
      shared: 'endpoints/shared',
      backend: 'endpoints/backend',
      sass: 'includes/scss',
      css: 'includes/css',
      src: 'app/src',
      tests: 'app/tests',
      docs: 'docs',
      views: 'app/views',
      routes: 'app/routes.php',
      config: 'app/config'
    },

    clean: {
      symlink: [
        '<%= paths.backend %>/includes/shared',
      ],
      sass: [
        '<%= paths.backend %>/<%= paths.css %>/main.css'
      ]
    },
    symlink: {
      includes: {
        files: [
            {
              src: '<%= paths.shared %>',
              dest: '<%= paths.backend %>/includes/shared'
            }
        ]
      }
    },
    chmod: {
        options: {
          mode: '777'
        },
        logs: {
          src: [
            'app/storage/',
            'app/storage/cache/',
            'app/storage/logs/',
            'app/storage/meta/',
            'app/storage/sessions/',
            'app/storage/views/',
            'vendor/ezyang/htmlpurifier/library/HTMLPurifier/DefinitionCache/Serializer'
          ]
        }
    },
    phpunit: {
      classes: {
        dir: '<%= paths.tests %>/phpunit'
      },
      options: {
        colors: true
      }
    },
    phpspec: {
      app: {
        specs: '<%= paths.tests %>/spec'
      }
    },
    phpdocumentor: {
      dist: {
        options: {
          directory : '<%= paths.src %>',
          target : '<%= paths.docs %>'
        }
      }
    },
    shell: {
      bowerBackend: {
        command: 'bower install',
        options: {
          execOptions: {
            cwd: 'endpoints/backend'
          }
        }
      },
      migrate: {
        command: function() {
          return 'php artisan migrate';
        }
      },
      dbseed: {
        command: function() {
          return 'php artisan db:seed';
        }
      },
      composerDontPromptForChanges: {
        command: 'composer config --global discard-changes true'
      }
    },
    sass: {
      backend: {
        options: {
          style: 'compressed',
          includePaths: ['<%= paths.backend %>/includes/vendor/foundation/scss']
        },
        files: {
          '<%= paths.backend %>/<%= paths.css %>/main.css':
            '<%= paths.backend %>/<%= paths.sass %>/main.scss'
        }
      },
    },
    wiredep: {
      localBackend: {
        src: [
          'app/views/backend/layouts/scripts/_local.blade.php'
        ],
        options: {
          directory: 'endpoints/backend/includes/vendor',
          bowerJson: require('./endpoints/backend/bower.json'),
          ignorePath: '../../../../../endpoints/backend/',
          exclude: [
            /modernizr/,
          ],
        },
        fileTypes: {
          html: {
            replace: {
              js: '<script src="\{\{asset(\'{{filePath}}\')\}\}"></script>',
            }
          },
        }
      },
      releaseBackend: {
        src: [
          'app/views/backend/layouts/scripts/_for-usemin.blade.php'
        ],
        options: {
          directory: 'endpoints/backend/includes/vendor',
          bowerJson: require('./endpoints/backend/bower.json'),
          ignorePath: '../../../../../endpoints/backend/',
          exclude: [
            /modernizr/,
          ],
        }
      }
    },
    useminPrepare: {
      backend: {
        src: 'app/views/backend/layouts/scripts/_for-usemin.blade.php',
        options: {
          dest: 'endpoints/backend'
        }
      },
      options: {
        type: 'html',
        flow: {
          backend: {
            steps: {
              js: ['concat']
            },
            post: {}
          },
        }
      }
    },
    db_dump: {
      db: {
        options: {
          title: "<%= custom_config.DB_SCHEMA %>",
          host: "<%= custom_config.DB_HOST %>",
          database: "<%= custom_config.DB_SCHEMA %>",
          user: "<%= custom_config.DB_USERNAME %>",
          pass: "<%= custom_config.DB_PASSWORD %>",
          backup_to: "backups/<%= custom_config.DB_SCHEMA %>-<%= grunt.template.today('yyyy-mm-dd-HH-MM-ss') %>.sql"
        },
      }
    },
    watch: {
      bower: {
        files: ['bower.json'],
        tasks: [
          'shell:bowerBackend',
          'wiredep:localBackend'
        ]
      },
      phpunit: {
        files: [
          '<%= paths.tests %>/phpunit/**/*.php',
          '<%= paths.src %>/**/*.php'
        ],
        tasks: ['phpunit','notify:phpunit']
      },
      phpspec: {
        files: [
          '<%= paths.tests %>/spec/**/*.php',
          '<%= paths.src %>/**/*.php'
        ],
        tasks: ['phpspec','notify:phpspec']
      },
      sass: {
        files: [
          '<%= paths.backend %>/<%= paths.sass %>/**/*.scss',
        ],
        tasks: ['sass','notify:sass']
      }
    },
    notify: {
      phpunit: {
        options: {
          title: 'PHPUnit',
          message: 'All tests passed.'
        }
      },
      phpspec: {
        options: {
          title: 'phpspec',
          message: 'All tests passed.'
        }
      },
      sass: {
        options: {
          title: 'Sass',
          message: 'CSS updated.'
        }
      },
      composer: {
        options: {
          title: 'Composer',
          message: 'Update finished.'
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-chmod');
  grunt.loadNpmTasks('grunt-composer');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-symlink');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-mysql-dump');
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-phpunit');
  grunt.loadNpmTasks('grunt-phpspec');
  grunt.loadNpmTasks('grunt-phpdocumentor');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-wiredep');
  grunt.loadNpmTasks('grunt-usemin');
  grunt.loadNpmTasks('grunt-contrib-concat');

  grunt.registerTask('default', [
    'composer:install',
    'symlink',
    'chmod',
    'shell:bowerBackend',
    'sass',
    'wiredep:localBackend',
    'shell:migrate',
    'shell:dbseed',
    'phpunit'
  ]);
  grunt.registerTask('test', [
    'shell:composerDontPromptForChanges',
    'composer:install',
    'symlink',
    'chmod',
    'shell:bowerBackend',
    'sass',
    'wiredep:releaseBackend',
    'myuseminBackend',
    'shell:migrate',
    'shell:dbseed'
  ]);
  grunt.registerTask('release', [
    'shell:composerDontPromptForChanges',
    'composer:install:no-dev',
    'symlink',
    'chmod',
    'shell:bowerBackend',
    'sass',
    'wiredep:releaseBackend',
    'myuseminBackend',
    'shell:migrate'
  ]);
  grunt.registerTask('myuseminBackend', [
    'wiredep:releaseBackend',
    'useminPrepare:backend',
    'concat'
    // don't call usemin itself because it overwrites the block in the file
    // we are using Laravel and a hard-coded script tag to handle that
  ]);
  grunt.registerTask('composer-update', function(env) {
    grunt.task.run(['composer:update','notify:composer']);
  });
}
