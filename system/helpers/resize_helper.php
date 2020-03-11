<?php

defined('BASEPATH') OR exit('No direct script access allowed');




if ( ! function_exists('resizeimage'))
{
	/**
	 * Formats a numbers as bytes, based on size, and adds the appropriate suffix
	 *
	 * @param	mixed	will be cast as int
	 * @param	int
	 * @return	string
	 */
	function resizeimage($filename,$width,$height)
	{
		
		$CI =& get_instance();		
		
		$CI->load->library('Image');
		
		if (!file_exists(DIR_IMAGE . $filename) || !is_file(DIR_IMAGE . $filename)) {
			
			$filename="no_image.jpg";
		}
		

		 $info = pathinfo($filename);

		
		$extension = $info['extension'];

		$old_image = $filename;

		$new_image = 'cache/' . substr($filename, 0, strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;


		if (!file_exists(DIR_IMAGE . $new_image) || (filemtime(DIR_IMAGE . $old_image) > filemtime(DIR_IMAGE . $new_image))) {

			$path = '';

			

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			

			

			foreach ($directories as $directory) {

				$path = $path . '/' . $directory;

				

				if (!file_exists(DIR_IMAGE . $path)) {

					@mkdir(DIR_IMAGE . $path, 0777);

				}		

			}

			

			

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);



			if ($width_orig != $width || $height_orig != $height) {
				
				$CI->image->cont(DIR_IMAGE .$old_image);
				
				$CI->image->resize($width, $height);

				$CI->image->save(DIR_IMAGE . $new_image);

			} else {

				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);

			}

		}

			return UPLOADFILE .$new_image;
	
	
		
	}
}
