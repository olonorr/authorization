<?php
require 'libs/rb-mysql.php';
require 'config.php';

try{
    $db = new PDO("mysql:host=${$config['db']['host']};dbname=${$config['db']['name']}",
        $config['db']['user'], $config['db']['password']);
} catch(PDOException $e){
    echo $e->getmessage();
}