<?php
class Helper
{
	public function load_helper($helpers = array())
	{
		//Helper path
		$helper_path = APP_PATH.'helper/';

		foreach($helpers as $helper){
			$helper_file = $helper_path . $helper . '.php';

			if(file_exists($helper_file))
			{
				include_once($helper_file);
			}
			else
			{
				echo 'Unable to load helper file';
			}
		}
	}
}