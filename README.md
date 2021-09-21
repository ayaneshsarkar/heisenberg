<p align="center"><img src="https://www.php.net//images/logos/new-php-logo.svg" width="250"></p>

## About HeisenbergMVC

HeisenbergMVC is really a great app for begginners. Really easy to setup and get started. We use a MVC structure like other popular PHP Frameworks. 

You get traditional Model, Controller and View relations with easy Database actions. More on below.

## Server Requirements

- Apache v2.0 or higher.
- MySQL
- PHP 7.4 or higher recommended
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
          ServerAlias heisenberg.local
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
        ServerAlias heisenberg.local
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
- `git clone https://github.com/ayaneshsarkar/heisenberg.git`
- `composer install`
- Create an empty database
- Copy `.env.sample` to `.env` and set up the Database Config.
  
- Open favourite browser and go to `http://__VIRTUALADDERESS__`
- **And there you go, HeisenbergMVC is installed!**