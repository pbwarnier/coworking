<?php
	$paths = explode('/', $_SERVER['SCRIPT_NAME']); // remove slash of the path
	$last_case = count($paths) - 1; // select the last array case
	if ($paths[$last_case - 1] == 'controllers') {
		$file = str_replace('_controller', '', $paths[$last_case]); // remove _controller extension in filename
		$file = explode('.', $file); // remove the file extension
		$filename = $file[0]; // filename
	}
	else{
		$file = explode('.', $paths[$last_case]); // remove the file extension
		$filename = $file[0]; // filename
	}
	