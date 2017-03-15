<?php // February 11, 2015

include ('functions.php');
function curl($url) {
	global $userAgent;
    // Assigning cURL options to an array
    $options = Array(
        CURLOPT_RETURNTRANSFER => TRUE,  // Setting cURL's option to return the webpage data
        CURLOPT_FOLLOWLOCATION => TRUE,  // Setting cURL to follow 'location' HTTP headers
        CURLOPT_AUTOREFERER => TRUE, 	// Automatically set the referer where following 'location' HTTP headers
        CURLOPT_CONNECTTIMEOUT => 5,   	// Setting the amount of time (in seconds) before the request times out
        CURLOPT_TIMEOUT => 5,  			// Setting the maximum amount of time for cURL to execute queries
        CURLOPT_MAXREDIRS => 10, 		// Setting the maximum number of redirections to follow
        CURLOPT_USERAGENT => $userAgent,  // Setting the useragent
        CURLOPT_URL => $url, 			// Setting cURL's URL option with the $url variable passed into the function
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_BINARYTRANSFER => 1
    );
	
    $ch = curl_init();  				// Initialising cURL 
    curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
    $data = curl_exec($ch); 			// Executing the cURL request and assigning the returned data to the $data variable
    curl_close($ch);    				// Closing cURL 
    return $data;   					// Returning the data from the function
}

// read lock
$myfile = fopen(__DIR__."/../data/lock.txt", "r") or die("Unable to open lock file! 1");
$lockStatus = fread($myfile,filesize(__DIR__."/../data/lock.txt"));
fclose($myfile);

//echo $lockStatus;

if ($lockStatus == 0){
	
	// set lock
	$myfile = fopen(__DIR__."/../data/lock.txt", "w") or die("Unable to open lock file! 2");
	$txt = 1;
	fwrite($myfile, $txt);
	fclose($myfile);
	
	debugLog('freshmaker: Hello! Sleeping 2 seconds.');
	sleep(2); // wait a time -- this prevents resources from being written while they're being read by the browser thereby causing corruption
	
	$resourceFilePath = __DIR__."/../data/resources.txt";
	$resourceArray = load_tabbed_file($resourceFilePath);
	
	$maxResourceAge = 480; // SETS THE MAXIMUM AGE OF CACHED FILES -- 600 = 10 min, 480 = 8 min
	
	/*
	var_dump($resourceArray);
	
	for($i=0;$i<=sizeof($resourceArray);$i++){
		echo $i;
		echo $resourceArray[$i][0];
		echo "<br/>";
	}*/

	for ($i=0; $i<=count($resourceArray)-1; $i++){						// for each element in $resourceArray,
		$url = $resourceArray[$i][0];									// $url is the url from the array.
		$filename = $resourceArray[$i][1];								// $filename is the filename from the array.
		$lastmodified = filemtime(__DIR__."/../data/".$filename);		// get file last modified time,
	   	$lapsedtime = time() - $lastmodified;							// calculate how old the file is.
	   	if ($lapsedtime > $maxResourceAge){								// if the file is older than specified,
			$data = curl($url);	// get data								// request it from the server
			if(strlen($data)>16){										// if curl actually got something (protects against sites being down)
				$file = fopen(__DIR__."/../data/".$filename, "w") or die("Error: Couldn't write cache file.");	// open a file
				fwrite($file, $data);									// write the data to the file,
				fclose($file);											// then close the file
				debugLog('freshmaker: '.$url.' ('.$filename.'): '.$lapsedtime.'s is too old. Refreshed!');
				sleep(1);												// wait a sec, let's not pound servers
			}
			else{
				debugLog('freshmaker: '.$url.' ('.$filename.'): returned no data. Did nothing!');
			}
	   	}
			 else {  debugLog('freshmaker: '.$url.' ('.$filename.'): '.$lapsedtime.'s is not old enough.'); }
	}
	/*
	// stupid code for the stupid terrace camera!!
	$lastmodified = filemtime(__DIR__."/../data/cam39.jpg");
	$lapsedtime = time() - $lastmodified;
	if ($lapsedtime > $maxResourceAge){
	   $options = array(
	  CURLOPT_RETURNTRANSFER => TRUE,
	  CURLOPT_URL => 'http://144.92.186.95:6010/netcam.jpg',
	);
	$ch = curl_init(); 
	curl_setopt_array($ch, $options);
	$data = curl_exec($ch);
	$file = fopen(__DIR__."/../data/cam39.jpg", "w") or die("Error: Couldn't write cache file.");
	fwrite($file, $data);
	fclose($file);
	 debugLog('freshmaker: Pesky cam39 image refreshed!');
	}
	else {  debugLog('freshmaker: Pesky cam39 image is not old enough.'); }
	*/
	
	//resize capitol building image
	$image = new SimpleImage();
	$image->load(__DIR__."/../data/cam1.jpg");
	$image->resize(640,360);
	$image->save(__DIR__."/../data/cam1.jpg");
	
	// resize some other image
	$image = new SimpleImage();
	$image->load(__DIR__."/../data/cam2.jpg");
	$image->resize(640,400);
	$image->save(__DIR__."/../data/cam2.jpg");
	
	//resize hackerspace image
	$image = new SimpleImage();
	$image->load(__DIR__."/../data/cam8.jpg");
	$image->resize(640,512);
	$image->save(__DIR__."/../data/cam8.jpg");

// unset lock

//sleep(5);

$myfile = fopen(__DIR__."/../data/lock.txt", "w") or die("Unable to open file!");
$txt = 0;
fwrite($myfile, $txt);
fclose($myfile);

}
else{
	debugLog("freshmaker: aborted due to file lock!");
}

debugLog('freshmaker: Goodbye!');