<?php
require_once 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

if(getenv('DEVELOPMENT')){
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', '1');
}else{
	ini_set('display_errors', '0');
}

$boostrap = new \Lib\Boostrap();

