<?php
require 'libs/rb-mysql.php';
require 'config.php';

R::setup("mysql:host=${$config['db']['host']};dbname=${$config['db']['name']}",
    $config['db']['user'], $config['db']['password']);