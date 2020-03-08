# Wellspring

For deployment we will be using Ubuntu 16.04. After installing the operating system run the following commands.

```
sudo apt-get update
sudo apt-get install -y apache2 mariadb-client php7.0 libapache2-mod-php7.0 php7.0-mysql
sudo service apache2 restart
```

Clone the github repository to /var/www/html

```
cd /var/www/html
git clone https://github.com/HRizwan1/Wellspring.git
```

Run the following command to create the MySQL user and create database/tables

```
$ mysql -u root -p
mysql> CREATE DATABASE website;
mysql> CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
mysql> GRANT ALL PRIVILEGES ON website.* TO 'username'@'localhost';
mysql> quit
$ cd /var/www/html/Wellspring
$ mysql -u username -p website < wellspring.sql
```

![screenshot](uploads/capture.png "Screenshot")