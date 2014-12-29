Deployment Tracker
====================

Tracks which of your applications are installed on which servers.

Installation
============

Make sure the following are installed on your system:

1. [Node.js, NPM](http://nodejs.org/), and [Grunt](http://gruntjs.com/installing-grunt) for build script.
2. [Composer](https://getcomposer.org/doc/00-intro.md) for PHP dependencies.
3. [Sass](http://sass-lang.com/install) (look for the command-line section) for stylesheets.

Then:

1. Create an app database starting with "l_". For example, "l_myappname". Create a user who can access the database. For local, it's good to name the user and password the same name as the database. If you like, you can use `/app/database/scripts/create-database.sql` as a starting point.
2. Duplicate `.env.example.json` as `.env.json` and enter the DB connection info and any other connection info.
3. Change the name of the app in the following places:
    - `app/src/NpmWeb/MyAppName` -- rename it to your app's name
    - `app/tests/` -- in multiple subdirs, look for `NpmWeb/MyAppName` and rename it to your app's name
    - Do a search-and-replace at the root of your project to replace "MyAppName" with your app's name that you chose above.
    - `app/views/[backend and frontend]/layouts/[_header and _headtag].blade`.php -- it should have already replaced MyApp Name with your app's name, but look and see if you want to add spaces, etc.
4. Run `sudo npm install` to install the grunt packages for this project.
5. Run `grunt`. This:
    - Installs PHP dependencies with `composer install`.
    - Creates symlinks for web assets with `symlink`.
    - Makes sure temp folders are writable with `chmod`.
    - Generates CSS from Sass.
    - Creates and populates the local database using
    
            php artisan migrate --env=backend-local
            php artisan db:seed --env=backend-local
            
    - Runs automated tests with `phpunit`
6. Set up MAMP to point `app/endpoints/frontend` and `backend` to the web address you want them at. For example, you could point http://local.my.northpointministries.net/myappname to `endpoints/frontend` and http://local.npmstaff.org/myappname to `endpoints/backend`
7. Edit `endpoints/[backend and frontend]/.htaccess`, changing the RewriteBase line to the path your app is at
8. When you're ready to code, run `grunt watch` (it will keep running in that terminal window). It will run unit tests as code changes, and recompile CSS as Sass changes. You'll see an OS  notification pop up if there are any problems.
