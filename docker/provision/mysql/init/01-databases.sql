CREATE DATABASE IF NOT EXISTS `assignment`;

CREATE USER 'development'@'localhost' IDENTIFIED BY 'development';
GRANT ALL ON *.* TO 'development'@'%';