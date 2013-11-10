<?php
class Auth_Model extends Model{
	private $_table = 'l5_users';

	public $login_rules = array(
		'username' => array('label' => 'Username', 'type' => 'raw', 'min' => 3, 'max' => 30, 'required' => TRUE, 'label' => 'Username'),
		'password' => array('label' => 'Password', 'type' => 'raw', 'min' => 3, 'max' => 30, 'required' => TRUE, 'label' => 'Password')
	);

	function __construct() {
		parent::__construct();
	}

	/**
	* Check valid user
	*
	* @author huynhbathanh@gmail.com
	* @param username, password
	* @return bool
	*/
	function check_login() {
		//check valid data
		$val = new Validation();
		$val->add_source($_POST);
		$val->add_rules($this->login_rules);
		$val->run();

		if(sizeof($val->errors) > 0) {
			return FALSE;
		} else {
			//Check valid user
			//TODO: Encrypted password before login
			//$encrypted_password = getHash($password);
			//var_dump($val->sanitized);

			$user = array(':username' => $val->sanitized['username'],
						  ':password' => $val->sanitized['password']);
			$strSQL = " SELECT id, username, password, fullname, gender, avarta "
					 ." FROM l5_users "
					 ." WHERE username = :username AND password = :password";

			$result = $this->_db->query($strSQL, $user)->fetchAll();

			if (sizeof($result) > 0) {
				return $result;
			}
		}

		return FALSE;
	}
}