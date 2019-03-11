## About Config

Copy ./config.dev.ini to config.ini and change the db config as per database server

## DB Install

There is sql dump file inside ./dbmigration/dbdump.sql, import/run SQL for mysql to create 
database and table with data

## Setup 

Clone the repositor into the lamp webserver web director,
Run composer install in the root directory after creating database as per "DB Install"
Browse index.php, should display the dataset output
