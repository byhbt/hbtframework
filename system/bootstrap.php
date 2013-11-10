<?php
/**
 * Bootstrap for handle url request
 */
class Bootstrap
{
	function __construct()
	{
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = filter_var($url, FILTER_SANITIZE_URL);
		//remove first and last slash
		$url = substr($url, -1, 1) == "/" ? substr($url, 0, -1) : $url;
		$url = explode('/', $url);

		//empty url
		if(empty($url[0]))
		{
			//Load default controller class/method
			$controller = DEFAULT_CONTROLLER;

			$controller = new $controller;
			$controller->index();
			return FALSE;
		}

		//class file
		$request_controller = $url[0];
		if(class_exists($request_controller)) {
			$controller = new $request_controller;
		}else{
			$this->error();
			return FALSE;
		}


		$length = count($url);
		//check method exist
		if($length > 1)
		{
			if(!method_exists($controller, $url[1]))
			{
				$this->error();
				return FALSE;
			}
		}


		//ERROR when there are 1 segment with the last slash
		//check method exist
		switch ($length) {
			case 5:
				$controller->{$url[1]}($url[2], $url[3], $url[4]);
				break;
			case 4:
				$controller->{$url[1]}($url[2], $url[3]);
				break;
			case 3:
				$controller->{$url[1]}($url[2]);
				break;
			case 2:
				$controller->{$url[1]}();
				break;
			case 1:
				$controller->index();
				break;
			default:
				$controller->index();
				break;
		}
	}

	function error()
	{
		$controller = new Error();
		$controller->index();

		return FALSE;
	}
}