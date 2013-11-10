<?php
/**
 * Handle session and set flash_data
 *
 * @package default
 * @author  huynhbathanh@gmail.com
 */

class Session
{
	private $started    = FALSE;
	private $msgTypes   = array('success', 'info', 'warning', 'danger');
	private $msgWrapper = "<div class='alert alert-%s'> %s </div>";
	private $msgBefore  = '';
	private $msgAfter   = "\n";

	/**
	* Constructor
	*
	* @author huynhbathanh@gmail.com
	*/
	public function __construct($autostart = TRUE) {
		$this->started = (isset($_SESSION)) ? TRUE : FALSE;

		if ($autostart == TRUE && $this->started == FALSE) {
			$this->start();
		}

		if (!array_key_exists('flash_messages', $_SESSION)) {
            $_SESSION['flash_messages'] = array();
		}
	}

	/**
	* Start new session or get old session
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return
	*/
	public function start() {
		if(!$this->started) {
			session_start();
			$this->started = TRUE;
		}
	}

	/**
	* Set a key
	*
	* @author huynhbathanh@gmail.com
	* @param $key
	* @param $value
	* @return
	*/
	public function set($key, $value) {
		$_SESSION[$key] = $value;
	}

	/**
	* get session variable
	*
	* @author huynhbathanh@gmail.com
	* @param session key
	* @return
	*/
	public function get($key) {
		if(isset($_SESSION[$key]))
			return $_SESSION[$key];
	}

	/**
	* Destroy session
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return
	*/
	public function destroy() {
		session_unset();
		session_destroy();
	}

	/**
	* add message to flash_message session
	*
	* @author huynhbathanh@gmail.com
	* @param  $type 'success', 'info', 'warning', 'danger'
	* @param  message array
	* @return bool
	*/
	public function addMessage($type, $message) {
        // Check parameter
        if (!isset($_SESSION['flash_messages'])) {
            return false;
        }

        if (!isset($type) || !isset($message[0])) {
            return false;
        }

		//Check message type
		if (!in_array($type, $this->msgTypes))
			die('Invalid message type');

		//Check session array
		if(!array_key_exists($type, $_SESSION['flash_messages']))
			$_SESSION['flash_messages'][$type] = array();


		$_SESSION['flash_messages'][$type][] = $message;

		return true;
	}

	/**
    * Add error from the validation
    *
    * @author huynhbathanh@gmail.com
    * @param
    * @return
    */
	public function add_validation_error($val_array){

        foreach ($val_array as $key => $value) {
            $this->addMessage('danger', $value);
        }
	}

	/**
	* Display message to user
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return
	*/
	public function displayMessage($type = 'all'){
		$messages = '';
		$result   = '';

		// Print a certain type of message
		if (in_array($type, $this->msgTypes)) {
			foreach ($_SESSION['flash_messages'][$type] as $msg){
				$messages .= $this->msgBefore . $msg . $this->msgAfter;
			}

			$result = sprintf($this->msgWrapper, $type, $messages);

		} elseif($type == 'all') {

			foreach ($_SESSION['flash_messages'] as $type => $msgArray) {
			    $messages = '';
				foreach ($msgArray as $msg) {
					$messages .= $this->msgBefore . $msg . "<br />" .$this->msgAfter;
				}

				$result .= sprintf($this->msgWrapper, $type, $messages);
			}
		}

		$this->clearMessage();

        //Clear session after display message
		return $result;
	}

	/**
	*	Clear message in the session after display
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return
	*/
	public function clearMessage($type='all') {
		if( $type == 'all' ) {
			unset($_SESSION['flash_messages']);
		} else {
			unset($_SESSION['flash_messages'][$type]);
		}
		return true;
	}

	/**
	*
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return
	*/
	public function hasError(){
		return empty($_SESSION['flash_messages']['error']) ? FALSE : TRUE;
	}

	/**
	*
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return
	*/
	public function hasMessage($type = null) {
		if (!null($type)) {
			if (!empty($_SESSION['flash_messages'][$type])) return $_SESSION['flash_messages'][$type];
		}else{
			foreach ($this->msgTypes as $type) {
				if (condition) {
					;
				}
			}
		}
	}
}
