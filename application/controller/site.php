<?php
/**
 * Site controller - Handle external request
 */

class Site extends Public_Controller {

	private $_session;
	private $_uid;

	public function __construct(){
		parent::__construct();

		$this->_session = new Session();

		if (is_logged_in())
			redirect('user/index');
	}

	public function index() {
		$this->view->render('welcome', TRUE);
	}

	public function register(){
		$this->view->render('register', TRUE);
	}

	public function login(){
		$this->view->render('login', TRUE);
	}
}
