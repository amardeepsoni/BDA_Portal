<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Image Manipulation class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Image_lib
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/image_lib.html
 */
class CI_Image {

	
    private $file;



    private $image;



    private $info;
	


	public function __construct($props = array())
	{
		if (count($props) > 0)
		{
			$this->initialize($props);
		}

		log_message('info', 'Image Lib Class Initialized');
	}
	
	
	public function cont($params)
		{
		
		if (file_exists($params)) {
			
			$this->file = $params;
			
			$info = getimagesize($params);
			
			$this->info = array(
			
            	'width'  => $info[0],

            	'height' => $info[1],

            	'bits'   => $info['bits'],

            	'mime'   => $info['mime']
        	);

        	$this->image = $this->create($params);

    	} 
		else 
		{
      		exit('Error: Could not load image ' . $params . '!');
    	}
	}
	
	private function create($image) {



		$mime = $this->info['mime'];


		if ($mime == 'image/gif') {



			return imagecreatefromgif($image);



		} elseif ($mime == 'image/png') {



			return imagecreatefrompng($image);



		} elseif ($mime == 'image/jpeg') {



			return imagecreatefromjpeg($image);



		}



    }	



	



    public function save($file, $quality = 90) {



		$info = pathinfo($file);



		$extension = strtolower($info['extension']);


		if (is_resource($this->image)) {



			if ($extension == 'jpeg' || $extension == 'jpg') {



				imagejpeg($this->image, $file, $quality);



			} elseif($extension == 'png') {



				imagepng($this->image, $file);



			} elseif($extension == 'gif') {



				imagegif($this->image, $file);



			}



			   



			imagedestroy($this->image);



		}



    }	    



	
 public function resize1($width = 0, $height = 0) {



    	if (!$this->info['width'] || !$this->info['height']) {



			return;



		}







		$xpos = 0;



		$ypos = 0;







		$scale = min($width / $this->info['width'], $height / $this->info['height']);



		



		if ($scale == 1 && $this->info['mime'] != 'image/png') {



			return;



		}



		



		$new_width = (int)($this->info['width'] * $scale);



		$new_height = (int)($this->info['height'] * $scale);			



    	$xpos = (int)(($width - $new_width) / 2);



   		$ypos = (int)(($height - $new_height) / 2);



        		        



       	$image_old = $this->image;



        $this->image = imagecreatetruecolor($width, $height);



			



		if (isset($this->info['mime']) && $this->info['mime'] == 'image/png') {		



			imagealphablending($this->image, false);



			imagesavealpha($this->image, true);



			$background = imagecolorallocatealpha($this->image, 255, 255, 255, 127);



			imagecolortransparent($this->image, $background);



		} else {



			$background = imagecolorallocate($this->image, 255, 255, 255);



		}



		



		imagefilledrectangle($this->image, 0, 0, $width, $height, $background);



	



        imagecopyresampled($this->image, $image_old,0, 0, 0, 0, $new_width, $height, $this->info['width'], $this->info['height']);



        imagedestroy($image_old);



           



        $this->info['width']  = $width;



        $this->info['height'] = $height;



    }
	
	
 public function resize2($width = 0, $height = 0) {



    	if (!$this->info['width'] || !$this->info['height']) {



			return;



		}







		$xpos = 0;



		$ypos = 0;







		$scale = min($width / $this->info['width'], $height / $this->info['height']);



		



		if ($scale == 1 && $this->info['mime'] != 'image/png') {



			return;



		}



		



		$new_width = (int)($this->info['width'] * $scale);



		$new_height = (int)($this->info['height'] * $scale);			



    	$xpos = (int)(($width - $new_width) / 2);



   		$ypos = (int)(($height - $new_height) / 2);



        		        



       	$image_old = $this->image;



        $this->image = imagecreatetruecolor($width, $height);



			



		if (isset($this->info['mime']) && $this->info['mime'] == 'image/png') {		



			imagealphablending($this->image, false);



			imagesavealpha($this->image, true);



			$background = imagecolorallocatealpha($this->image, 255, 255, 255, 127);



			imagecolortransparent($this->image, $background);



		} else {



			$background = imagecolorallocate($this->image, 255, 255, 255);



		}



		



		imagefilledrectangle($this->image, 0, 0, $width, $height, $background);



	



        imagecopyresampled($this->image, $image_old,0, 0, 0, 0, $width, $height, $this->info['width'], $this->info['height']);



        imagedestroy($image_old);



           



        $this->info['width']  = $width;



        $this->info['height'] = $height;



    }


    public function resize($width = 0, $height = 0) {


    	if (!$this->info['width'] || !$this->info['height']) {



			return;



		}







		$xpos = 0;



		$ypos = 0;







		$scale = min($width / $this->info['width'], $height / $this->info['height']);







		if ($scale == 1 && $this->info['mime'] != 'image/png') {



			return;



		}



		



		$new_width = (int)($this->info['width'] * $scale);



		$new_height = (int)($this->info['height'] * $scale);			



    	$xpos = (int)(($width - $new_width) / 2);



   		$ypos = (int)(($height - $new_height) / 2);



		  



       	$image_old = $this->image;



        $this->image = imagecreatetruecolor($width, $height);



			



		if (isset($this->info['mime']) && $this->info['mime'] == 'image/png') {		



			imagealphablending($this->image, false);



			imagesavealpha($this->image, true);



			$background = imagecolorallocatealpha($this->image, 255, 255, 255, 127);



			imagecolortransparent($this->image, $background);



		} else {



			$background = imagecolorallocate($this->image, 255, 255, 255);



		}



		



		imagefilledrectangle($this->image, 0, 0, $width, $height, $background);



	



        imagecopyresampled($this->image, $image_old, $xpos, $ypos, 0, 0, $new_width, $new_height, $this->info['width'], $this->info['height']);



        imagedestroy($image_old);



           



        $this->info['width']  = $width;



        $this->info['height'] = $height;



    }



    



    



	



    public function watermark($file, $position = 'bottomright') {



        $watermark = $this->create($file);



        



        $watermark_width = imagesx($watermark);



        $watermark_height = imagesy($watermark);



        



        switch($position) {



            case 'topleft':



                $watermark_pos_x = 0;



                $watermark_pos_y = 0;



                break;



            case 'topright':



                $watermark_pos_x = $this->info['width'] - $watermark_width;



                $watermark_pos_y = 0;



                break;



            case 'bottomleft':



                $watermark_pos_x = 0;



                $watermark_pos_y = $this->info['height'] - $watermark_height;



                break;



            case 'bottomright':



                $watermark_pos_x = $this->info['width'] - $watermark_width;



                $watermark_pos_y = $this->info['height'] - $watermark_height;



                break;



        }



        



        imagecopy($this->image, $watermark, $watermark_pos_x, $watermark_pos_y, 0, 0, 120, 40);



        







        imagedestroy($watermark);



    }



    



    public function crop($top_x, $top_y, $bottom_x, $bottom_y) {



        $image_old = $this->image;



        $this->image = imagecreatetruecolor($bottom_x - $top_x, $bottom_y - $top_y);



        



        imagecopy($this->image, $image_old, 0, 0, $top_x, $top_y, $this->info['width'], $this->info['height']);



        imagedestroy($image_old);



        



        $this->info['width'] = $bottom_x - $top_x;



        $this->info['height'] = $bottom_y - $top_y;



    }



    



    public function rotate($degree, $color = 'FFFFFF') {



		$rgb = $this->html2rgb($color);



		



        $this->image = imagerotate($this->image, $degree, imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]));



        



		$this->info['width'] = imagesx($this->image);



		$this->info['height'] = imagesy($this->image);



    }



	    



    private function filter($filter) {




        imagefilter($this->image, $filter);



    }



            



    private function text($text, $x = 0, $y = 0, $size = 5, $color = '000000') {



		$rgb = $this->html2rgb($color);



        



		imagestring($this->image, $size, $x, $y, $text, imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]));



    }



    



    private function merge($file, $x = 0, $y = 0, $opacity = 100) {



        $merge = $this->create($file);







        $merge_width = imagesx($image);



        $merge_height = imagesy($image);



		        



        imagecopymerge($this->image, $merge, $x, $y, 0, 0, $merge_width, $merge_height, $opacity);



    }



			



	private function html2rgb($color) {



		if ($color[0] == '#') {



			$color = substr($color, 1);



		}



		



		if (strlen($color) == 6) {



			list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);   



		} elseif (strlen($color) == 3) {



			list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);    



		} else {



			return false;



		}


		$r = hexdec($r); 



		$g = hexdec($g); 



		$b = hexdec($b);    



		



		return array($r, $g, $b);



	}	

}
