A very lightweight Bitcoin Node Monitor
=================================================

Monitor your Bitcoin node from a webpage on Pi, allowing you to set up a web server on your Pi and access all the information about your Lightning/Bitcoin node in one place. Can be accessed by all devices on your network.

If you need a guide how to set up your Bitcoin Node and LND then I have a guide [here](https://robert-askam.co.uk/posts/post/set-up-and-running-a-bitcoin-lightning-full-node-on-raspberry-pi "Robert Askam")


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

cd /var/www
rm -rf html
git clone [INSERT CLONE HERE] html
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

Donations
-----
If this has helped feel free to donate

BTC: 3HrdXMjhFVGvc93kTs6vujRmztRBZtkrA9

ETH: 0x12Fa142034B348DDB8563A65AdB732efB23e6710 or ENS rbaskam.etherbase.eth
