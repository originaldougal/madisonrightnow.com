<?php
include_once('functions.php');

$totaluse=0;
$totalcapacity=0;

$locations = array
  (
  "1"=>array
  (
  "name"=>"University Av. Ramp (20)",
  "regex"=>'~UNIVERSITY AVE RAMP</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  ),
  "2"=>array
  (
  "name"=>"Nicholas Hall Garage (27)",
  "regex"=>'~NICHOLAS HALL GARAGE</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  ),
  "3"=>array
  (
  "name"=>"Observatory Dr. Ramp (36)",
  "regex"=>'~OBSERVATORY DR RAMP</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  ),
  "4"=>array
  (
  "name"=>"HC White Library LL (6L)",
  "regex"=>'~HC WHITE GARAGE LOWR</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  ),
  "5"=>array
  (
  "name"=>"HC White Library UL (6U)",
  "regex"=>'~WHITE GARAGE UPPR</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>1000
  ),
  "6"=>array
  (
  "name"=>"Grainger Garage (7)",
  "regex"=>'~GRAINGER HALL GARAGE</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  ),
  "7"=>array
  (
  "name"=>"N. Park St. Ramp (29)",
  "regex"=>'~PARK STREET RAMP</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  ),
  "8"=>array
  (
  "name"=>"Lake &amp; Johnson Ramp (46)",
  "regex"=>'~JOHNSON RAMP</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  ),
  "9"=>array
  (
  "name"=>"Fluno Garage (83)",
  "regex"=>'~FLUNO CENTER GARAGE</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  ),
  "10"=>array
  (
  "name"=>"Engineering Dr. Ramp (17)",
  "regex"=>'~ENGINEERING DR RAMP</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  ),
  "11"=>array
  (
  "name"=>"Union South Garage (80)",
  "regex"=>'~UNION SOUTH GARAGE</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  ),
  "12"=>array
  (
  "name"=>"University Bay Dr. Ramp (76)",
  "regex"=>'~UNIV BAY DRIVE RAMP</td><td align="right">(.+?)</td><td align="right">~',
  "totalspaces"=>999
  )
);


$file = fopen(__DIR__."/../data/parking_campus.txt", "r") or die("Unable to open file!");
$data = fread($file,filesize(__DIR__."/../data/parking_campus.txt"));
fclose($file);

for ($i=1; $i<=count($locations); $i++){
	
	?><div style="padding-left:10px;padding-right:10px;"><?
	
	$loc_name = $locations[$i]["name"];
	$regex = $locations[$i]["regex"];
	preg_match($regex,$data,$match);
	$loc_vacancy = $match[1];
	$loc_utilization = round(number_format((1-($match[1]/$locations[$i]["totalspaces"]))*100,1),0);
	$loc_total = $locations[$i]["totalspaces"];
	$totaluse=$totaluse+($locations[$i]["totalspaces"]-$match[1]);
	$totalcapacity = $totalcapacity + $loc_total;
		?>
		<p><?=$loc_name?><br/>
		<small><? echo "<strong>".$loc_vacancy."</strong> visitor spaces available."; ?></small></p>
	</div>
	<hr/>
<?
}
?>