<?php
class Private_Controller extends Controller{
	protected $_session;
	protected $_uid;

	function __construct(){
		parent::__construct();

		//check session
		if (!is_logged_in())
			redirect('auth/login');

		$this->load_model('user_model');
		$this->load_model('relation_model');

		//Any private session?
		$this->_session = new Session();
		$this->_uid = $this->_session->get('uid');
	}
}

