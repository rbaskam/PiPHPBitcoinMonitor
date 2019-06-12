A very lightweight Bitcoin Node Monitor
=================================================

Monitor your Bitocin node from a webpage on Pi


Installation
---------------

Set up your Pi Apache Server

```js
sudo apt update
sudo apt upgrade
sudo apt update

sudo apt install apache2

sudo chown -R pi:www-data /var/www/html/
sudo chmod -R 770 /var/www/html/

sudo apt install php php-mbstring

sudo rm /var/www/html/index.html

echo "<?php phpinfo ();?>" > /var/www/html/index.php

//On another PC go to your IP address and you should have the PHP Info Page
```

Go to your php.ini file and remove the ; mark from the beginning of the following line:
```js
;extension=php_curl.dll
```

Run
```js
sudo apt-get install php-curl
/etc/init.d/apache2 restart
OR
sudo service apache2 reload
OR
sudo service apache2 restart
```

Usage
-----

### Configure the node page
```js
cp .env.example .env
nano .env
//Put your username and password from your bitcoin.conf file saved on the node.
```


