<?php
function is_logged_in() {
	$session = new Session();

	if(!$session->get('uid')){
		return FALSE;
	}

	return TRUE;
}

function is_admin() {
	$session = new Session();

		if($session->get('level') == 2)
			return TRUE;

	return FALSE;
}

function get_client_ip() {
	$ipaddress = '';
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(!empty($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if(!empty($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(!empty($_SERVER['HTTP_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if(!empty($_SERVER['REMOTE_ADDR']))
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';

	return $ipaddress;
}

function redirect($to_page){
	header('Location: '. BASE_URL . '/' .$to_page);
}