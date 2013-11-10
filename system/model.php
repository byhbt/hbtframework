<?php
//Abstract model
class Model
{
	protected $_db;

	public function __construct(){
		$this->_db = new MyPDO(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	}

	public function load_model($name){
		$this->$name = new $name;
	}
}