<?php
/**
 * Validation class
 */

class Validation
{
	public $errors =  array();
	public $sanitized = array();

	private $validation_rules = array();
	private $source = array();

	public function add_source($source, $trim = FALSE) {
		$this->source = $source;
	}

	public function run() {
		foreach (new ArrayIterator($this->validation_rules) as $var => $opt) {
			if(isset($opt['required']) && $opt['required'] == TRUE) {
				$this->is_set($var);
			}

			if(isset($opt['trim']) && $opt['trim'] == TRUE) {
				$this->source[$var] = trim($this->source[$var]);
			}

			switch ($opt['type']) {
				case 'email':
					$this->validateEmail($var, $opt['required'], $opt['label']);
					if(!array_key_exists($var, $this->errors)) {
						$this->sanitizeEmail($var);
					}
					break;
				case 'numeric':
					$this->validateNumeric($var, $opt['required']);
					if(!array_key_exists($var, $this->errors)) {
						$this->sanitizeNumeric($var);
					}
					break;
				case 'string':
					$this->validateString($var, $opt['min'], $opt['max'], $opt['required']);
					if(!array_key_exists($var, $this->errors)) {
						$this->sanitizeString($var);
					}
					break;
				case 'float':
					$this->validateFloat($var, $opt['required']);
					if(!array_key_exists($var, $this->errors)) {
						$this->sanitizeFloat($var);
					}
					break;
				case 'username':
					$this->validateUsername($var, $opt['min'], $opt['max'], $opt['required'], $opt['label']);
					if (!array_key_exists($var, $this->errors)) {
						$this->sanitizeUsername($var);
					}
					break;
				case 'ustring':
					$this->validateUstring($var, $opt['min'], $opt['max'], $opt['required'], $opt['label']);
					if (!array_key_exists($var, $this->errors)) {
						$this->sanitizeUstring($var);
					}
					break;
				case 'date':
					$this->validateDate($var, $opt['min'], $opt['max']);
					if (!array_key_exists($var, $this->errors)) {
						$this->sanitizeDate($var);
					}
					break;
				case 'birthday':
					$this->validateBirthday($var, $opt['min'], $opt['max'], $opt['max']);
					if (!array_key_exists($var, $this->errors)) {
						$this->sanitizeBirthday($var);
					}
					break;
				case 'numeric_range':
					$this->validateNumericRange($var, $opt['max'], $opt['min']);
					if(!array_key_exists($var, $this->errors)) {
						$this->sanitizeNumericRange($var);
					}
					break;
				case 'password':
					$this->validatePassword($var, $opt['max'], $opt['min'], $opt['required'], $opt['label']);
					if(!array_key_exists($var, $this->errors)) {
						$this->sanitizePassword($var);
					}
					break;
				case 'gender':
					$this->validateGender($var, $opt['data'], $opt['label']);
					if(!array_key_exists($var, $this->errors)) {
						$this->sanitizeGender($var);
					}
					break;
				case 'raw':
					$this->validateRaw($var, $opt['label'], $opt['max'], $opt['min'], $opt['required']);
					if (!array_key_exists($var, $this->errors)) {
						$this->sanitizeRaw($var);
					}
					break;
				case 'user_id':
					$this->validateUserId($var, $opt['label']);
					if(!array_key_exists($var, $this->errors)) {
						$this->sanitizeUserId($var);
					}
			}
		}
	}

	/**
	 * Check Add rule to validation class
	 */
	public function add_rules(array $rules_array) {
		$this->validation_rules = array_merge($this->validation_rules, $rules_array);
	}

	/**
	 * Check Required data
	 */
	private function is_set($var) {
		if(!isset($this->source[$var])) {
			$this->errors[$var] = $var . ' is not set.';
		}
	}

	/**
	 * Check Required data
	 */
	public static function required($str) {
		return (!empty($str));
	}

	private function validateNumeric($var, $required=false) {
		if($required==false && strlen($this->source[$var]) == 0) {
			return TRUE;
		}

		if(filter_var($this->source[$var], FILTER_VALIDATE_INT)===FALSE) {
			$this->errors[$var] = $var . ' is an invalid number';
		}
	}


	/**
	 * Validate String with MIN and MAX
	 */
	private function validateString($var, $min=0, $max=0, $required=FALSE) {
		if($required == FALSE && strlen($this->source[$var]) == 0) {
			return TRUE;
		}

		if(isset($this->source[$var])) {
			if(strlen($this->source[$var]) == 0){
				$this->errors[$var] = $var . ' cannot be empty';
			} elseif(strlen($this->source[$var]) < $min) {
				$this->errors[$var] = $var . ' is too short';
			} elseif(strlen($this->source[$var]) > $max) {
				$this->errors[$var] = $var . ' is too long';
			} elseif(!is_string($this->source[$var])) {
				$this->errors[$var] = $var . ' is invalid';
			}
		}
	}

	/**
	 * Validate String only
	 */
	private function validateUstring($var, $min=3, $max=10, $required=FALSE, $label) {
		if($required == FALSE && strlen($this->source[$var]) == 0) {
			return TRUE;
		}

		if(strlen($this->source[$var]) == 0){
			$this->errors[$var] = $label . ' cannot be empty';
		} elseif(strlen($this->source[$var]) < $min)  {
			$this->errors[$var] = $label . ' is too short';
		} elseif(strlen($this->source[$var]) > $max) {
			$this->errors[$var] = $label . ' is too long';
		} elseif(!is_string($this->source[$var])) {
			$this->errors[$var] = $label . ' is invalid';
		}
	}

	private function sanitizeUstring($var) {
		$this->sanitized[$var] = $this->source[$var];
	}

	private function sanitizeNumeric($var) {
		$this->sanitized[$var] = (int) filter_var($this->source[$var], FILTER_SANITIZE_NUMBER_INT);
	}

	private function validateFloat($var, $required=FALSE) {
		if($required==false && strlen($this->source[$var]) == 0) {
			return true;
		} if(filter_var($this->source[$var], FILTER_VALIDATE_FLOAT) === false) {
			$this->errors[$var] = $var . ' is an invalid float';
		}
	}

	private function sanitizeString($var) {
		$this->sanitized[$var] = (string) filter_var($this->source[$var], FILTER_SANITIZE_STRING);
	}

	/**
	 * Validate User ID exist or not
	 */
	private function validateUserID($var, $required=FALSE) {
		if($required == FALSE && strlen($this->source[$var]) == 0) {
			return TRUE;
		}

		if(filter_var($this->source[$var], FILTER_VALIDATE_INT)===FALSE) {
			$this->errors[$var] = 'Invalid user';
		} else {
			$db = new MyPDO(DB_HOST, DB_NAME, DB_USER, DB_PASS);

			//PDO cannot bind table name parameter directly
			$sql = "SELECT id, username FROM l5_users WHERE id = :value";
			$user = array('value' => $this->source[$var]);
			$st  = $db->query($sql, $user);

			if(!$st) {
				$this->errors[$var] = $label . ' is invalid user.';
			}
		}
	}

	private function sanitizeUserID($var) {
		$this->sanitized[$var] = (int) filter_var($this->source[$var], FILTER_VALIDATE_INT);
	}

	/**
	 * Validate Group ID exist or not
	 */
	private function validateGroupID($var, $required=FALSE) {
		if($required == FALSE && strlen($this->source[$var]) == 0) {
			return TRUE;
		}

		if (!Group::check_group_id($this->source[$var])) {
			$this->errors[$var] = 'Invalid group';
		}
	}

	private function sanitizeGroupID($var) {

		$this->sanitized[$var] = $this->source[$var];
	}

	/**
	 * Validate Username exist or not
	 */
	private function validateUsername($var, $min=0, $max=0, $required=TRUE, $label = '') {
		if(isset($this->source[$var])) {
			//Check characters
			if(strlen($this->source[$var]) == 0){
				$this->errors[$var] = $label . ' cannot be empty';
			}elseif(strlen($this->source[$var]) < $min){
				$this->errors[$var] = $label . ' is too short';
			}elseif(strlen($this->source[$var]) > $max){
				$this->errors[$var] = $label . ' is too long';
			}elseif(!is_string($this->source[$var])){
				$this->errors[$var] = $label . ' is invalid';
			}

			//Check duplicate
			$db 		= new MyPDO(DB_HOST, DB_NAME, DB_USER, DB_PASS);
			$sql 		= "SELECT username FROM l5_users WHERE username = :value";
			$user 		= array('value' => $this->source[$var]);
			$statement  = $db->query($sql, $user);

			if($statement->rowCount() > 0){
				$this->errors[$var] = $label . ' has already existed.';
			}
		}
	}

	private function sanitizeUsername($var) {
		$this->sanitized[$var] = $this->source[$var];
	}


	private function validateBirthday($var, $min, $max, $label) {
		$date = explode('-', $this->source[$var]);

		$month = $date[2];
		$day   = $date[1];
		$year  = $date[0];

		if($year > $max || $year < $min){
			$this->errors[$var] = 'Your age is not accepted to join our website!';
		}elseif (!checkdate($month, $day, $year)){
			$this->errors[$var] = 'Birthday is incorrect.';
		}
	}

	private function sanitizeBirthday($var) {
		$this->sanitized[$var] = date('Y-m-d', strtotime($this->source[$var]));
	}


	private function validateDate($var, $min, $max) {
		$datePattern = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';

		if(!preg_match($datePattern, $this->source[$var])) {
			$this->errors[$var] = 'Birthday is incorrect';
		}

		$date = explode('/', $this->source[$var]);

		$month = $date[0];
		$day   = $date[1];
		$year  = $date[2];

		if($year > $max || $year < $min){
			$this->errors[$var] = 'Your age is not accepted to join our website!';
		}elseif (!checkdate($month, $day, $year)){
			$this->errors[$var] = 'Birthday is incorrect.';
		}
	}

	private function sanitizeDate($var) {
		$this->sanitized[$var] = date('Y-m-d', strtotime($this->source[$var]));
	}

	private function validateNumericRange($var, $max, $min) {
		$number = $this->source[$var];

		if($number > $max || $number < $min) {
			$this->errors[$var] = $var . ' is out of range.';
		}
	}

	private function sanitizeNumericRange($var) {
		$this->sanitized[$var] = $this->source[$var];
	}

	private function validatePassword($var, $max, $min, $required=TRUE, $label = '') {
		if($required == FALSE && strlen($this->source[$var]) == 0) {
			return TRUE;
		}

		if(strlen($this->source[$var]) == 0){
			$this->errors[$var] = $label . ' cannot be empty';
		}elseif(strlen($this->source[$var]) < $min){
			$this->errors[$var] = $label . ' is too short';
		}elseif(strlen($this->source[$var]) > $max){
			$this->errors[$var] = $label . ' is too long';
		}
		elseif(!is_string($this->source[$var]))
		{
			$this->errors[$var] = $label . ' is invalid';
		}
	}

	private function sanitizePassword($var) {
		$this->sanitized[$var] = $this->source[$var];
	}

	private function validateGender($var, $genders = array(), $label) {
		if(!in_array($this->source[$var], $genders)) {
			$this->errors[$var] =  $label . ' is not correct';
		}
	}

	private function sanitizeGender($var) {
		$this->sanitized[$var] = $this->source[$var];
	}

	/**
	* trim and check valid string
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return null
	*/
	private function validateRaw($var, $label, $max, $min, $required=TRUE) {
		if($required == FALSE && strlen($this->source[$var]) == 0) {
			return TRUE;
		}

		if(strlen($this->source[$var]) == 0){
			$this->errors[$var] = $label . ' cannot be empty';
		}elseif(strlen($this->source[$var]) < $min) {
			$this->errors[$var] = $label . ' is too short';
		} elseif(strlen($this->source[$var]) > $max) {
			$this->errors[$var] = $label . ' is too long';
		} elseif(!is_string($this->source[$var])) {
			$this->errors[$var] = $label . ' is invalid';
		}
	}

	private function sanitizeRaw($var) {
		$this->sanitized[$var] = $this->source[$var];
	}

	/**
	* Validate email address
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return
	*/
	private function validateEmail($var, $required=TRUE, $label){
		if($required == FALSE && strlen($this->source[$var]) == 0) {
			return TRUE;
		}

		if(strlen($this->source[$var]) == 0){
			$this->errors[$var] = $label . ' cannot be empty';
		}

		//use php default filter
		if (!filter_var($this->source[$var], FILTER_VALIDATE_EMAIL)){
			$this->errors[$var] = $label . ' is invalid.';
		}else{
			$db = new MyPDO(DB_HOST, DB_NAME, DB_USER, DB_PASS);
			$sql = "SELECT email FROM l5_users WHERE email = :value";
			$user = array('value' => $this->source[$var]);
			$st  = $db->query($sql, $user);

			if ($st->rowCount() > 0) {
				$this->errors[$var] = $label . ' is existed.';
			}
		}
	}

	/**
	* Push data into sanitized array
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return
	*/
	private function sanitizeEmail($var){
		//TODO: Not completed yet
		$this->sanitized[$var] = $this->source[$var];
	}
}