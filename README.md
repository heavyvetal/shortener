# Shortener

This is a simple URL shortener that will help to replace any link with its short version.

**System requirements**
- PHP >= 8.1
- XML PHP Extension
- cURL PHP Extension
- MySQL or MariaDB
- Apache 2
- Composer

## Installation
### Windows

Clone git repo
>$ git clone https://github.com/heavyvetal/shortener.git

Change directory 
>$ cd shortener

Install dependencies via Composer.
>$ composer install

Create .env file from .env.example.
>$ cp .env.example .env
   
Generate a key.
>$ php artisan key:generate
   
Create a database, name it **"shortener"** and create tables using
>$ php artisan migrate
>
#### Create virtual host in Apache 
Add this code to **apache\conf\httpd.conf**
```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/shortener"
    ServerName test.shortener
</VirtualHost>
```
Add such a record in **etc\drivers\hosts** 
>127.0.0.1 test.shortener
***
### Linux

Clone git repo to /var/www.<br>
>$ git clone https://github.com/heavyvetal/shortener.git
>
Change directory to /var/www/shortener.
>$ cd shortener
>
Set permissions by 
>$ sudo chmod -R 777 * 
>
and define an owner by 
>$ sudo chown -R $USER:$USER .
  
Install dependencies via Composer.
>$ composer install
   
Create .env file from .env.example.
>$ cp .env.example .env
   
Generate a key.
>$ php artisan key:generate
   
#### Create virtual host in Apache 
Rename **/var/www/shortener** to **/var/www/test.shortener**

Add such a record in **/etc/hosts**
>127.0.0.1 test.shortener
          
Create a configuration file in **/etc/apache2/sites-available/** and name it as **test.shortener.conf**
           
Insert into it this code
```
<VirtualHost *:80>
    ServerAdmin admin@test.com
    ServerName test.shortener
    DocumentRoot /var/www/test.shortener/public
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
    <Directory /var/www/test.shortener/public>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        allow from all
   </Directory>
</VirtualHost>
```
   
Run these commands
>$ sudo a2ensite test.shortener.conf

>$ sudo systemctl restart apache2


After that check http://test.shortener

Create a database, name it **"shortener"** and create tables using
>$ php artisan migrate
>
