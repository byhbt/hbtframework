<?php
function getHash($string) {
	if(!empty($string)){
		return md5(SALT.$string); //SALT from config file
	}

	return FALSE;
}