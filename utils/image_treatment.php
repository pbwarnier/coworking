<?php
	function copyFile($folder, $file){
		$verification = false;
		$compt_copy = 1; // copy name extension
		while (!$verification){
			$path = pathinfo($folder.$file);
			$file = $path['filename'].'_'.$compt_copy.'.'.$path['extension']; // composition of the filename
			if (!file_exists($folder.$file)){ $verification = true; }
			$compt_copy++;
		}
		return $folder.$file;
	}

	function resize_crop_image($max_width, $max_height, $source_file, $dst_dir){
        $imgsize = getimagesize($source_file); // get size of this picture
        $width = $imgsize[0]; // image width
        $height = $imgsize[1]; // height image
        $mime = $imgsize['mime'];

        // switch is equivalent to a series of instructions if
        switch($mime) {
            case 'image/gif':
                $image_create = "imagecreatefromgif"; // creates a new image from a file or URL
                $image = "imagegif"; // displays the image to the browser or in a file
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng"; // creates a new image from a file or URL
                $image = "imagepng"; // displays the image to the browser or in a file
                $quality = 8;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg"; // creates a new image from a file or URL
                $image = "imagejpeg"; // displays the image to the browser or in a file
                $quality = 90;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height); // create new image with colors
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if ($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            // copy, resize, resample an image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }
        else {
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            // copy, resize, resample an image
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if ($dst_img)imagedestroy($dst_img);
        if ($src_img)imagedestroy($src_img);
    }