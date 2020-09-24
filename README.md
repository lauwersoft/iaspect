# PHP Assignment
This is a basic PHP 7.4 / Apache / Mysql docker environment to create your PHP Assignment 

## Requirements Mac / Windows
* Docker Desktop (Mac / Windows) : https://www.docker.com/products/docker-desktop

## Requirements Linux
* Docker Engine  : https://docs.docker.com/engine/install/ubuntu/
* Docker-compose : https://docs.docker.com/compose/install/

## First time installation
* Clone or download this project 
* Add `127.0.0.1 php.docker.test` to your host file
* CD to your project directory (on your harddrive) and run : `docker-compose up -d` 
* Open a terminal and enter the docker container with : `docker exec -it app-php-assignment bash`
* Run `composer install`
* Exit the container with `exit`
* Open a browser and go to http://php.docker.test/
 
## Starting / Stopping enviroment
* From your terminal, CD to your project on your harddrive
* Run : `docker-compose up -d`   
* In your browser, go to http://php.docker.test/
* Stop: to stop the Docker environment, run : `docker-compose down`

## Running PHPUnit tests 
* Enter the docker container (from your terminal) with : `docker exec -it app-php-assignment bash`
* Run PHPUnit tests : `./vendor/bin/phpunit src/tests/`

## Connect to Mysql database
* External (e.g Workbench, Sequel Pro etc) `host:localhost , port:3306  credentials:development / development, database=assignment`.
* Internal (from the application / Docker) `host:db-php-assignment , port:3306,  credentials:development / development, database=assignment`
* Example connection with PDO : `$db = new PDO('mysql:host=db-php-assignment; dbname=assignment', 'development', 'development');`
