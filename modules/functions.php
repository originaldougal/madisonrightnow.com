<?php

//error_reporting(0);		// suppress errors

$userAgent = "Mozilla/5.0 (compatible; Dougalbot/1.0; +http://www.madisonrightnow.com)";

// Extracts content from scraped pages
function scrape_between($data, $start, $end){
	$data = stristr($data, $start); 			// Stripping all data from before $start
	$data = substr($data, strlen($start));  	// Stripping $start
	$stop = stripos($data, $end);   			// Getting the position of the $end of the data to scrape
	$data = substr($data, 0, $stop);    		// Stripping all data from after and including the $end of the data to scrape
	return $data;   							// Returning the scraped data from the function
}

// Jan 27 2015 log file writer
function writeToLogFile($msg) {
     $today = date("Y_m_d"); 
     $logfile = $today."_log.txt"; 
     $dir = 'data/logs';
     $saveLocation=$dir . '/' . $logfile;
     if  (!$handle = @fopen($saveLocation, "a")) {
          exit;
     }
     else {
          if (@fwrite($handle,"$msg\r\n") === FALSE) {
               exit;
          }
   
          @fclose($handle);
     }
}

// Feb 2 2015
function debugLog($msg) {
	$logfile = __DIR__."/../data/logs/debugLog.txt";
	//file_put_contents($logfile, date("Y-m-d h:i:s A")." : ".$msg."\n", FILE_APPEND);
}

function freshness(){
	$maxResourceAge = 600; // 600 = 10min
	$filename = "cam1.jpg";											// $filename is the file name.
	$lastmodified = filemtime(__DIR__."/../data/".$filename);		// get file last modified time,
   	$lapsedtime = time() - $lastmodified;							// calculate how old the file is.
   	if ($lapsedtime > $maxResourceAge){								// if the file is older than specified,
		 return true;
		 debugLog('functions.php>freshness(): true');
	}
  
	else {  
		 return false;
		 debugLog('functions.php>freshness(): false');
	}
}

// Image resizing implemented 2/13/2015. Copyright: 2006 Simon Jarvis. http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
class SimpleImage {
   var $image;
   var $image_type;
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }
   }
   function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
}

//
// load a tab seperated text file as array
//
function load_tabbed_file($filepath, $load_keys=false){
    $array = array();
 
    if (!file_exists($filepath)){ return $array; }
    $content = file($filepath);
 
    for ($x=0; $x < count($content); $x++){
        if (trim($content[$x]) != ''){
            $line = explode("\t", trim($content[$x]));
            if ($load_keys){
                $key = array_shift($line);
                $array[$key] = $line;
            }
            else { $array[] = $line; }
        }
    }
    return $array;
}

?>