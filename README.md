## Step by step setup the project in server 

* Required
* * Ubuntu ver >= 22.04
* * php ver >= 8.1
* * nginx ver >= 1.18.0
* * mariadb ver >= 10.6.16
* * composer ver >= 2.6.6
* * git ver >= 2.34.1

* Step by step deployment in server
* * Login to Mariadb database with user root and create a database by command line: 
* * * CREATE DATABASE gwdstatus; 
* * Git clone repo sourcecode in main branch by command line: 
* * * git clone https://github.com/codewithmmike/status.gowithdev.net.git 
* * Set permission for storage folder by command line: 
* * * chmod -R 775 storage 
* * * chown -R nginx:nginx storage
* * Run composer install & composer update by command line: 
* * * composer install && composer update 
* * Run migration database by command line: 
* * * php artisan migrate:fresh 
* * Configurate nginx service redirect to folder: 
* * * root /path/to/project/public;
