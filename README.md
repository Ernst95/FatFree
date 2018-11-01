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

#Composer
composer install




