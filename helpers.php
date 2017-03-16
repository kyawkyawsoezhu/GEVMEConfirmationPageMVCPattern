<?php

function view($file,$vars = []) {
	$file = "app.Views.".$file;
	$file = str_replace('.', '/', $file);
	$file = rtrim($file,'.php').'.php';
	
	if(!empty($vars)){
		extract($vars);
	}
	include_once($file);
}

function config($var = false) {
	foreach (glob("config/*.php") as $filename) {
	    $path = dirname(__FILE__) . '/' . $filename;
	    if (is_file($path)) {
	    	$config[rtrim(basename($filename),'.php')] = (require $path);
	    }
	}
	if($var){
		foreach(explode('.', $var) as $arr){
			$config = $config[$arr];
		}
		return $config;
		
	}
	return $config;
}

function pd($data , $die = true){
	echo "<pre>";
		print_r($data);
	echo "</pre>";
	if ($die) die();
}

function console($value, $return = false){
        static $count = 0;
        $string = json_encode(print_r($value, true));
        if (!$return)
        {
            $count++;
            echo("<script>console.log('Output $count:');</script>");
            echo("<script>console.log($string);</script>");
        }
        else
            return $string;
}