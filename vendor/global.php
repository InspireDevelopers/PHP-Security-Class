<?php

		$dir = "";
		$files = glob($dir . '*.php');
		

		foreach ($files as $file) {
		    require_once($file);   
		}

?>