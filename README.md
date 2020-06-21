<p align="center"><img src="https://www.php.net//images/logos/new-php-logo.svg" width="250"></p>

## About AyaneshMVC

AyaneshMVC is really a great app for begginners. Really easy to setup and get started. We use a MVC structure like other popular PHP Frameworks. 

You get traditional Model, Controller and View relations with easy Database actions. More on below.

Big Shoutout to [Mr. Brad Traversey](https://github.com/bradtraversy) who actually designed this framework and the credit goes to him. I just added Sass and ES6 compiler, and the usage of it can be found on the docs below.

## Server Requirements

- Apache v2.0 or higher.
- PHP v5.0 or higher. (PHP 7.0 or higher recommended)
- Nodejs v12.0 or higher.
- NPM Package Manager v6.0 or higher installed with Nodejs.
- Git v2.0 or higher.

## Vertual Server Creation

Before installing AyaneshMVC we need to create a Virtual Server to get our app running. When you are using a project for production, it is highly recommended to create a Virtual Server, that's why we are making it from the start.

Steps are below.

  ## For Windows

   - Go to your root Apache folder (For most Xampp users, it is in the `C:/xampp/apache`). 
   - Edit `conf/httpd.conf` and uncomment these three lines.
     - Set `#LoadModule rewrite_module modules/mod_rewrite.so` to 
       `LoadModule rewrite_module modules/mod_rewrite.so`.

     - Set `#LoadModule vhost_alias_module modules/mod_vhost_alias.so` to 
       `LoadModule vhost_alias_module modules/mod_vhost_alias.so`.

     - Set `#Include conf/extra/httpd-vhosts.conf` to `Include conf/extra/httpd-vhosts.conf`.
   - Go to `conf/extra/httpd-vhosts.conf`.
     - At the bottom of the document add the following lines.
     - 
        `<VirtualHost *:80>`<br />
          &nbsp;&nbsp;&nbsp;&nbsp;`ServerAdmin webmaster@localhost`<br />
          &nbsp;&nbsp;&nbsp;&nbsp;`ServerName ayaneshmvc.local`<br />
          &nbsp;&nbsp;&nbsp;&nbsp;`ServerAlias www.ayaneshmvc.local`<br />
          &nbsp;&nbsp;&nbsp;&nbsp;`DocumentRoot "[__PATH TO YOUR PROJECT FOLDER__]"`<br />

          &nbsp;&nbsp;&nbsp;&nbsp;`<Directory "[__PATH TO YOUR PROJECT FOLDER__]">`<br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`Options Indexes FollowSymLinks`<br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`AllowOverride All`<br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`Require all granted`<br />
          &nbsp;&nbsp;&nbsp;&nbsp;`</Directory>`<br />

          &nbsp;&nbsp;&nbsp;&nbsp;`ErrorLog logs/ayaneshmvc.error.log`<br />
          &nbsp;&nbsp;&nbsp;&nbsp;`CustomLog logs/ayaneshmvc.custom.log`<br />
      `</VirtualHost>`
   - Change `ServerName` and `ServerAlias` to your choosing, but add the `.local` in the last.
   - `ServerName` will be used to access the `URLROOT` during the installation, so have that in mind.
   - **NOTE:** When you type the `ServerName` in your browser, add `http://` before it.
   - Change the `__PATH TO YOUR FOLDER__` to the actual path of your **Project Folder**.
   - Restart Apache.
   - **There you go, the Virtual Server is ready to start.**

## Installation

Installing AyaneshMVC is easy. Here are the steps below on how to properly install AyaneshMVC.

- Open your Terminal or Command Prompt or Powershell
- `git clone https://github.com/ayaneshsarkar/ayaneshmvc.git`
- `npm install`
- Create an empty database
- Go to `app/config/config.php` and change the following.
  - `define('DB_HOST', '__DBHOST__')`  Change `__DBHOST__` to your Database Host
  - `define('DB_USER', '__DBUSER__')`  Change `__DBUSER__` to your Database User
  - `define('DB_PASS', '__DBPASS__')`  Change `__DBPASS__` to your Database Password
  - `define('DB_NAME', '__DBNAME__')`  Change `__DBNAME__` to your Database Name

  - `define('URLROOT', '__URLROOT__')` Change `__URLROOT` to your Virtual Server Name as mentioned above
  - `define('SITENAME', '__SITENAME__')`
- **And there you go, AyaneshMVC is installed!**