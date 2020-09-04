<?php
	function folder_size($link) {
        $root = opendir($link);
        $size = 0;
        while ($folder = readdir($root)) {
        	if ($folder != '..' && $folder != '.') {
            	//Ajoute la taille du sous dossier
            	if (is_dir($link.'/'.$folder)) { $size += folder_size($link.'/'.$folder); }
            	//Ajoute la taille du fichier
            	else { $size += filesize($link.'/'.$folder); }
          	}
        }
        
        closedir($root);
        return $size;
    }

	function ext_size($size){
		$i = 0;
		$extension = ['octets', 'Ko', 'Mo', 'Go'];
		if ($size < 1024) {
    		return $size.' '.$extension[$i];
    	}
    	else {
     		while ($size > 1024) {
     			// affiche 2 chiffres après la virgule
        		$size = round($size / 1024, 2);
        		$i++;
    		}
     		return $size.' '.$extension[$i];
   		}
	}