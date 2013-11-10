<?php
class Upload{
	/**
	* Upload file to server
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return bool
	*/
	public function do_upload($uploaded_file){

		$myfile = $_FILES[$uploaded_file];

		if(!isset($myfile)){
			return FALSE;
		}

		//validate upload path
		if (!is_uploaded_file($myfile)) {
			return FALSE;
		}

		$name = preg_replace("/[^A-Z0-9._-]/i", "_", $myfile["name"]);
		$i = 0;
		$parts = pathinfo($name);

		while (file_exists(UPLOAD_DIR . $name))	{
			$i++;
			$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		}
	}

	/**
	*
	*
	* @author huynhbathanh@gmail.com
	* @param
	* @return
	*/
	public function resize() {

	}


}