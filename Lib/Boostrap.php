<?php
namespace Lib;

use App\Controller;

class Boostrap{

	private $contoller_class;
	private $contoller;
	private $routeURL;

	function __construct()
	{
		$this->routeURL = $this->routeURL();
		$this->initController();
		if($this->checkMethodExist()){
			$this->initMethod();
		}
	}

	function routeURL()
	{
		$url = isset($_GET['url']) ? strtolower($_GET['url']) : null;
		$url = rtrim(trim($url),'/');
		$url = filter_var($url,FILTER_SANITIZE_URL);
		$url = explode('/', $url);
		return $url;		
	}

	public function initController()
	{
		if (empty($this->routeURL[0])) {
			$this->contoller_class = "\App\Controllers\HomeController";
		}else{
			$this->contoller_class = '\App\Controllers\\'.ucfirst($this->routeURL[0]).'Controller';
		}

		if(class_exists($this->contoller_class)){
			$this->contoller = new $this->contoller_class;
		}else{
			$this->errorMessage($this->contoller_class . " Not Found");
		}		

	}

	public function checkMethodExist()
	{
		if (!empty($this->routeURL[1])) {
			if (!method_exists($this->contoller_class,$this->routeURL[1])) {
				$this->errorMessage("method <b> " . $this->routeURL[1] . "</b> not found in " . $this->contoller_class . " class");
			}
		}
		return true;
	}

	public function initMethod()
	{
		$length = count($this->routeURL);
		switch (($length-1)) {
			case 4:
				$this->contoller->{$this->routeURL[1]}($this->routeURL[2],$this->routeURL[3],$this->routeURL[4]);
				break;
			case 3:
				$this->contoller->{$this->routeURL[1]}($this->routeURL[2],$this->routeURL[3]);
				break;
			case 2:
				$this->contoller->{$this->routeURL[1]}($this->routeURL[2]);
				break;
			case 1:
				$this->contoller->{$this->routeURL[1]}();
				break;
			default:
				$this->contoller->index();
				break;
		}
	}

	public function errorMessage($message = 'We got some errors') // Temporary
	{
		echo "<p>";
			echo $message;
		echo "</p>";
		return false;
	}

	
}
?>