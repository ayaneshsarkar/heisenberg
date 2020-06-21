<p align="center"><img src="https://www.php.net//images/logos/new-php-logo.svg" width="250"></p>

## About HeisenbergMVC

HeisenbergMVC is really a great app for begginners. Really easy to setup and get started. We use a MVC structure like other popular PHP Frameworks. 

You get traditional Model, Controller and View relations with easy Database actions. More on below.

Big Shoutout to [Mr. Brad Traversey](https://github.com/bradtraversy) who actually designed this framework and the credit goes to him. I just added Sass and ES6 compiler, and the usage of it can be found on the docs below.

## Server Requirements

- Apache v2.0 or higher.
- MySQL
- PHP v5.0 or higher. (PHP 7.0 or higher recommended)
- Nodejs v12.0 or higher.
- NPM Package Manager v6.0 or higher installed with Nodejs.
- Git v2.0 or higher.

## Virtual Server Creation

Before installing HeisenbergMVC we need to create a Virtual Server to get our app running. When you are using a project for production, it is highly recommended to create a Virtual Server, that's why we are making it from the start.

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

        ```
        <VirtualHost *:80>
          ServerAdmin webmaster@localhost
          ServerName heisenberg.local
          ServerAlias www.heisenberg.local
          DocumentRoot "[__PATH TO YOUR PROJECT FOLDER__]"

          <Directory "[__PATH TO YOUR PROJECT FOLDER__]">
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
          </Directory>

          ErrorLog logs/heisenberg.error.log
          CustomLog logs/heisenberg.custom.log common
        </VirtualHost>
        
        ```

   - Change `ServerName` and `ServerAlias` of your choosing, but add the `.local` in the last.
   - `ServerName` will be used to access the `URLROOT` during the installation, so have that in mind.
   - **NOTE:** When you type the `ServerName` in your browser, add `http://` before it.
   - Change the `__PATH TO YOUR FOLDER__` to the actual path of your **Project Folder**.
   - Edit `C:/Windows/System32/drivers/etc/hosts`
   - Type
      ```
      127.0.0.1 heisenberg.local
      
      ```
   - Restart Apache.
   - **There you go, the Virtual Server is ready to start.**

  ## For Linux (Debian based...example: Ubuntu) 

   - Go to your root Apache folder and open in Terminal (For Lamp Stack users, it is in the `/etc/apache2`). 
   - We're going to create a new configuaration rather than adding it to the Host `conf` file.
   - `$` `sudo nano sites-available/heisenberg.conf` 
     - Here we are naming the conf file `heisenberg.conf`, you can name it whatever you want, but remember it for the setup purposes.
   - 
     ```
      <VirtualHost *:80>
        ServerAdmin webmaster@localhost
        ServerName heisenberg.local
        ServerAlias www.heisenberg.local
        DocumentRoot "[__PATH TO YOUR PROJECT FOLDER__]"

        <Directory "[__PATH TO YOUR PROJECT FOLDER__]">
          Options Indexes FollowSymLinks
          AllowOverride All
          Require all granted
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
      </VirtualHost>

     ```

   - Change `ServerName` and `ServerAlias` of your choosing, but add the `.local` in the last.
   - `ServerName` will be used to access the `URLROOT` during the installation, so have that in mind.
   - **NOTE:** When you type the `ServerName` in your browser, add `http://` before it.
   - Change the `__PATH TO YOUR FOLDER__` to the actual path of your **Project Folder**.  
   - Save the file.
   - `$` `sudo a2ensite heisenberg.conf`
   - `$` `sudo a2dissite 000-default.conf` 
     - If you have any other default configuration already set up, then type that instead of `000-default.conf`  
   - `$` `sudo a2enmod rewrite`  
   - `$` `sudo nano /etc/hosts`
   - Type
     ```
     127.0.0.1 heisenberg.local

     ```
   - Save the file.
   - `$` `sudo systemctl restart apache2` OR `sudo service apache2 reload`

## Installation

Installing HeisenbergMVC is easy. Here are the steps below on how to properly install HeisenbergMVC.

- Open your Terminal or Command Prompt or Powershell
- `git clone https://github.com/ayaneshsarkar/heisenbergmvc.git`
- `npm install`
- Create an empty database
- Go to `app/config/config.php` and change the following.
  - `define('DB_HOST', '__DBHOST__')`  Change `__DBHOST__` to your Database Host
  - `define('DB_USER', '__DBUSER__')`  Change `__DBUSER__` to your Database User
  - `define('DB_PASS', '__DBPASS__')`  Change `__DBPASS__` to your Database Password
  - `define('DB_NAME', '__DBNAME__')`  Change `__DBNAME__` to your Database Name

  - `define('URLROOT', '__URLROOT__')` Change `__URLROOT__` to your Virtual Server Name as mentioned above
  - `define('SITENAME', '__SITENAME__')` Change `__SITENAME__` to the Site Name of your choice.
  
- Open favourite browser and go to `http://__VIRTUALADDERESS__`
- **And there you go, HeisenbergMVC is installed!**

![Installed Image](https://www.dropbox.com/s/v8qa3rdb34dwb4h/heisenbergmvc.JPG?raw=1)

## Sass

In 2020, Sass is the most efficient way to write CSS. Even if you are using [Bootstrap](https://getbootstrap.com), you probably use Sass to customize it. And of course if you prefer to use normal CSS, you can also stick to that, even if the extension of the file is `.scss`, this is very basic. 

In HeisenbergMVC we will be using `.scss` files which will be compiled to normal CSS in your public folder. As mentioned above, you can use normal CSS in the `.scss` files. 

We are using [Gulp](https://gulpjs.com/) to compile Sass to CSS. There are many ways, but we are sticking to [Gulp](https://gulpjs.com/). So, make sure you used `npm install` during the installtion of our project.


- To write Sass code or CSS, go to `app/resources/sass/`.
- Here you can create `.scss` files to write sass which will be compiled to CSS in the `public/css` folder.
- You need to include the CSS file into your respective `.php` file `<head>` tag.
  - Example: If you create `app.scss` then you need to add this in the `<head>` tag
    ```
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/app.css">
    ```
  - Remember in the `<head>` tag you need to add `.css` not `.scss` because it will compile into CSS in the `public/css` folder.
- You can always use the traditional Sass folder structure and import other files.
- You can create a folder inside the `sass` folder and add those files which you want to import to the root `.scss` file.

- You need to run `npm run gulp-sass` OR `npm run dev` in the terminal to see the changes take place.
- If don't prefer use `npm run gulp-sass` OR `npm run dev` everytime you change something you may want to use
   `npm run gulp-watch` OR `npm run watch`. 
- **There you go! You just learned how to add Sass or CSS in the HeisenbergMVC.**

## JavaScript

Ofcourse, you are going to use JavaScript. 

Many versions of popular browsers don't support ES7 or Async-Await code. We made sure you will not have the problem. 

We will be using [Webpack](https://webpack.js.org/) and [Babel](https://babeljs.io/) to compile JavaScript to ES6 which is readable by almost all browsers. We could have used [Gulp](https://gulpjs.com/) like we used to compile Sass, but it is sensible to use [Webpack](https://webpack.js.org/) and [Babel](https://babeljs.io/) to compile JavaScript, it is a far better choice. 

Here are the steps on how to use Javascript to HeisenbergMVC.

- Go to `app/resources/js/app.js`.
- Whatever JavaScript you want to write, has to be written at `app.js`.
- You may want to create a folder inside the `app/resources/js/` and add the `.js` files which you want to import in the `app.js` file. This is a traditional JavaScript folder structure.

- If you want to rename `app.js`, you also need to make changes to the `webpack.config.js` file in the root folder.
- JavaScript will be compiled to single `index.js` file at `public/js` folder which you can add into the body of your `.php` file. 

- The changes will take place after you run `npm run webpack` OR `npm run dev`.
- If you don't want to run `npm run webpack` OR `npm run dev` every time you make changes, then you may run `npm run webpack-watch` OR `npm run watch`.

- **There you go! You just learned how to add JavaScript in the HeisenbergMVC.**