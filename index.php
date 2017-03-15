<? $time_start = microtime(true); include_once("modules/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Real-time information about Madison, Wisconsin">
    <meta name="keywords" content="Madison Wisconsin, dane, webcams, cameras, live, news, traffic, weather, MSN, KMSN, airport, WI, city, beltline, conditions, traffic, road, civic data">
    <meta name="author" content="originaldougal.com">
    <meta name="mobile-web-app-capable" content="yes">
    <title>MadisonRightNow [<?=date("g:i")?>]</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/madisonrightnow.css" rel="stylesheet">
	<link href="css/social-buttons-3.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
    <link rel="manifest" href="manifest.json">
	<link rel="icon" sizes="192x192" href="app-icon.png">

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/jquery.lazy.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCcondMztKRTPqKuizkkGwqZR3guNA2DvM"></script>
	<script src="js/mapinit.js"></script>
	<script async="" defer="" src="//survey.g.doubleclick.net/async_survey?site=yffdeoo36pilsbbbcvtihbaf74"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<a name="thetop"></a>
	<? flush(); include('modules/disclaimer.php'); ?>
    <div id="wrapper">
        <div class="container" id="main">
            <div class="row">
				<div class="col-md-6">
					<? flush(); if($_REQUEST['log'] == 1){ include('modules/logreader.php'); } ?>
					<? flush(); include('modules/logo.php'); ?>
					<? flush(); include('modules/weather.php'); ?>
					<? flush(); include('modules/cameras.php'); ?>
					<? flush(); include('modules/breakingnews.php'); ?>
					<? flush(); //include('modules/reddit.php'); ?>
					<? flush(); include('modules/deals.php'); ?>
					<? flush(); include('modules/events.php'); ?>
				</div>
				<div class="col-md-6">
					<? flush(); include('modules/traffic.php'); ?>
					<? flush(); include('modules/parking.php'); ?>
					<? flush(); include('modules/flights.php'); ?>
					<? flush(); include('modules/radio.php'); ?>
					<? flush(); include('modules/news.php'); ?>
					<? flush(); include('modules/hackerspace.php'); ?>
					</div>
			</div>
			<? flush(); include('modules/footer.php'); ?>
        </div><!-- cl container -->
    </div><!-- cl wrapper -->
</body>

<script async src="js/ga.js"></script>
<script src="js/madisonrightnow.js"></script>

</html>

<?
flush();

/* DISABLED THIS METHOD OF CALLING THE FRESHMAKER ON OCT 15 2015 BECAUSE IT STOPPED WORKING ON SEPT 25
// run the background process
$execCmd = "/usr/bin/php -f ~/www/madisonrightnow.com/modules/freshmaker.php";
$outputFile = '/dev/null';
$pidFile = '/dev/null';
exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $execCmd, $outputFile, $pidFile));
*/


// Get cURL resource THIS IS THE NEW WAY TO CALL THE FRESHMAKER
$curl = curl_init();
// Set some options
curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://madisonrightnow.com/modules/freshmaker.php'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

include_once('modules/logger.php');
$time_end = microtime(true);
$execution_time = ($time_end - $time_start);
echo '<!-- generated in '.$execution_time.' sec-->';
flush();

?>