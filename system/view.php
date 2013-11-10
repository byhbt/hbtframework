<?php
class View
{
	private $vars = array();

	public function __construct()
	{

	}

	public function __set($index, $value)
	{
		$this->vars[$index] = $value;
	}

	public function render($name, $_modal = FALSE)
	{
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}

		if (!$_modal) {
			//Load profile view
			require( APP_PATH . 'view' . DS . 'common' . DS . '_header.php');
			require( APP_PATH . 'view' . DS . $name . '.php');
			require( APP_PATH . 'view' . DS . 'common' . DS . '_footer.php');
		} else {
			//Load modal view
			require( APP_PATH . 'view' . DS . 'common' . DS . '_modal_header.php');
			require( APP_PATH . 'view' . DS . $name . '.php');
			require( APP_PATH . 'view' . DS . 'common' . DS . '_modal_footer.php');
		}
	}

	public function render_friend($name){
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}

		require( APP_PATH . 'view' . DS . 'common' . DS . '_friend_header.php');
		require( APP_PATH . 'view' . DS . $name . '.php');
		require( APP_PATH . 'view' . DS . 'common' . DS . '_friend_footer.php');
	}

	public function render_login($name){
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}

		require( APP_PATH . 'view' . DS . 'common' . DS . '_modal_login_header.php');
		require( APP_PATH . 'view' . DS . $name . '.php');
		require( APP_PATH . 'view' . DS . 'common' . DS . '_modal_footer.php');
	}

	public function load($name){
		foreach ($this->vars as $key => $value){
			$$key = $value;
		}

		ob_start();
		require( APP_PATH . 'view' . DS . $name . '.php');
		$result = ob_get_contents();
		ob_end_clean();

		return $result;
	}
}
