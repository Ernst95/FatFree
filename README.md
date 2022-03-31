# FatFree
Learning Fat-Free Framework

#VHost setup
<VirtualHost fatfree.local:80>
    ServerName fatfree.local
    DocumentRoot "directory where code is stored"
    <Directory "directory where code is stored">
        Options -Indexes +FollowSymLinks +Includes
        AllowOverride All
        Order allow,deny
        Allow from All
		Require all granted
    </Directory>
</VirtualHost>

#PHP version
    1. Make sure you are using PHP version 7

#Composer
    1. composer install

#Populate tables
    1. First create a database called "salon"
    2. Execute the populateDB.php file in the cmd to populate the database with data

#Debug settings for docker VSCode
    {
        {
        "name": "Listen for XDebug on Docker",
        "type": "php",
        "request": "launch",
        "port": 9003,
        "pathMappings": {
            "/var/www/html/": "${workspaceFolder}"
        }
    }