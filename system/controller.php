<?php
class Controller
{
	function __construct(){
		$this->view = new View();
	}

	function load_model($name){
		$this->$name = new $name;
	}
}