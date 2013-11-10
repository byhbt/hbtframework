<?php
/**
 * use spl_autoload_register() to load neccessary libraries
 */

class Loader {
	private $paths;

	function __construct($path) {
		$this->paths = $path;
	}

	function init() {
		spl_autoload_register(array($this, 'load'));
	}

	function load($class_name) {
		$class_file = '';

		foreach($this->paths as $path) {
			$class_file = $path . $class_name . '.php';

			if (file_exists($class_file))
			{
				require($class_file);
				return;
			}
		}
	}
}
