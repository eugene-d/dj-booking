#!/usr/bin/env bash

echo "##########Installing app##########";
apt-get update;
apt-get install -y python-software-properties;
add-apt-repository ppa:ondrej/php5-5.6;
apt-get update;
apt-get install -y mc;
apt-get install -y git;
apt-get install -y php5;
apt-get install -y php5-mcrypt;
apt-get install -y php5-mysql;

#modRewrite
sudo a2enmod rewrite;
sudo sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf;

#change Apache user
sudo sed -i 's/www-data/vagrant/g' /etc/apache2/envvars;

sudo /etc/init.d/apache2 restart;