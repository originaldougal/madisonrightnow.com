<?php
//include_once('functions.php');

$today = date("Y_m_d"); 
$filename = $today."_log.txt"; 

$file = fopen(__DIR__."/../data/logs/".$filename, "r") or die("Error: Couldn't read log file.");
$data = fread($file,filesize(__DIR__."/../data/logs/".$filename));
$data = str_replace("\n","<br/>",$data);
fclose($file);

?>

<div class="panel panel-info" style="margin-bottom: 26px;">
	<div class="panel-body">
		<div class="row">
			<a name="footer"></a>
			<div class="col-xs-12" style="margin: 6px;">
		    	<p><?=$data?>
			</div>
		</div>
	</div>
</div>