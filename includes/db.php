<?php
require 'libs/rb-mysql.php';
require 'config.php';
$name = $config['db']['name'];

R::setup( "mysql:host=${$config['db']['localhost']};dbname=$name",
    $config['db']['user'], $config['db']['password']);
