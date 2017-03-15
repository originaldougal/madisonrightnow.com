<?php

include_once('functions.php');



$totaluse=0;

$totalcapacity=0;



$locations = array

  (

  "1"=>array

  (

  "name"=>"Brayton Lot",

  "regex"=>'~Brayton Lot</a></div>

                               

                               <div class="spotsOpen">(.+?)</div>~',

  "rate"=>1.5,

  "totalspaces"=>247

  ),

  "2"=>array

  (

  "name"=>"Capitol Square North Garage",

  "regex"=>'~Capitol Square North Garage</a></div>

                               

                               <div class="spotsOpen">(.+?)</div>~',

  "rate"=>1,

  "totalspaces"=>613

  ),

  "3"=>array

  (

  "name"=>"Government East Garage",

  "regex"=>'~Government East Garage</a></div>

                               

                               <div class="spotsOpen">(.+?)</div>~',

  "rate"=>1.5,

  "totalspaces"=>516

  ),
 
  "4"=>array

  (

  "name"=>"Overture Center Garage",

  "regex"=>'~Overture Center Garage</a></div>

                               

                               <div class="spotsOpen">(.+?)</div>~',

  "rate"=>0.75,

  "totalspaces"=>620

  ),

  "5"=>array

  (

  "name"=>"State Street Campus Garage",

  "regex"=>'~State Street Campus Garage</a></div>

                               

                               <div class="spotsOpen">(.+?)</div>~',

  "rate"=>1.25,

  "totalspaces"=>1061

  ),

  "6"=>array

  (

  "name"=>"State Street Capitol Garage",

  "regex"=>'~State Street Capitol Garage</a></div>

                               

                               <div class="spotsOpen">(.+?)</div>~',

  "rate"=>1,

  "totalspaces"=>850

  )

);





$file = fopen(__DIR__."/../data/parking.txt", "r") or die("Unable to open file!");

$data = fread($file,filesize(__DIR__."/../data/parking.txt"));

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

		<small><? echo $loc_total-$loc_vacancy." of ".$loc_total." are full. <strong>".$loc_vacancy."</strong> spaces available."; ?></small></p>

		<div class="progress">

		  	<div class="progress-bar" role="progressbar" aria-valuenow="<? echo $loc_utilization; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <? echo $loc_utilization; ?>%;">

		    <? echo $loc_utilization; ?>% full

		  	</div>

		</div>

	</div>

<?

}



$sys_utilization = round($totaluse/$totalcapacity * 100,0);

?>

<hr/>

<div style="padding-left:10px;padding-right:10px;">

	<p>Total System Utilization</p>

	<div class="progress">

	  	<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<? echo $sys_utilization; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <? echo $sys_utilization; ?>%;">

	    <? echo $sys_utilization; ?>%

	  	</div>

	</div>

</div>
