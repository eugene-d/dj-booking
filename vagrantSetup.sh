#!/usr/bin/env bash

DBPASSWORD='123';

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

#mysql
debconf-set-selections <<< 'mysql-server mysql-server/root_password password $DBPASSWORD';
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password $DBPASSWORD';
apt-get install -y mysql-server;
mysql -uroot -p123 -e "GRANT ALL PRIVILEGES ON *.* TO forge@localhost IDENTIFIED BY ''"
mysql -uroot -p123 -e "DROP DATABASE IF EXISTS \`forge\`";
mysql -uroot -p123 -e "CREATE DATABASE \`forge\` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci";

#phpmyadmin
debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true";
debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWORD";
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWORD";
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWORD";
debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2";
apt-get -y install phpmyadmin;
ln -s /usr/share/phpmyadmin/ /vagrant/public/phpmyadmin;

#modRewrite
sudo a2enmod rewrite;
sudo sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf;

#change Apache user
sudo sed -i 's/www-data/vagrant/g' /etc/apache2/envvars;

if ! [ -L /var/www/html ]; then
  rm -rf /var/www/html;
  ln -fs /vagrant/public /var/www/html;
fi

sudo /etc/init.d/apache2 restart;