<?
include_once('functions.php');

$file = fopen(__DIR__."/../data/snow.txt", "r") or die("Unable to open file!");
$data = fread($file,filesize(__DIR__."/../data/snow.txt"));
fclose($file);

$raw_report = scrape_between($data,'<div class="outline_box_image">','</div>');
//$snowEmergency = str_replace("/residents/winter/images/", "http://www.cityofmadison.com/residents/winter/images/", $raw_report);

$path = '<img alt="snow emergency image" class="img-responsive lazy" src="/data/images/';
if (strpos($a,'SnowEmergencyYes.jpg') !== false) {
    $snowEmergency = $path.'SnowEmergencyYes.jpg">"';
    $toggle = "in";
}
else{
	$snowEmergency = $path.'SnowEmergencyNo.jpg">';
}
?>
<a name="parking"></a>
<div class="panel-group" id="masterGroupParking">
	<div class="panel panel-info d-shadow">
	<div class="panel-heading">
           <div class="panel-title">
           		<p><a data-toggle="collapse" href="#collapseParking" id="tab3" class="collapsed">Parking</a></p>
            </div>
	</div>
	<div id="collapseParking" class="panel-collapse collapse">
    	<div class="panel-body">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h4 class="panel-title"><a data-toggle="collapse" href="#collapseCityParking" id="tab250">City Lots</a></h4>
	            </div>
	            <div id="collapseCityParking" class="panel-collapse collapse">
	                <div class="panel-body">
    					<?  include('modules/parking_engine.php'); ?>
    	  			  	<p style="padding-left: 10px;"><small>Figures are approximate and may fluctuate quickly.</small></p>

					        <div class="panel panel-default">
					            <div class="panel-heading">
					                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordionParkingMap" href="#collapseParkingMap" id="tab259">Parking facility map</a></h4>
					            </div>
					            <div id="collapseParkingMap" class="panel-collapse collapse">
					                <div class="panel-body">
										<img alt="camera image" class="lazy img-responsive" src="/data/images/parkingmap.jpg" width="600">
					                </div>
					            </div>
					        </div>

    		    	</div>
            	</div>
        	</div>
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h4 class="panel-title"><a data-toggle="collapse" href="#collapseCampusParking" id="tab251">Campus Lots</a></h4>
	            </div>
	            <div id="collapseCampusParking" class="panel-collapse collapse">
	                <div class="panel-body">
	                <br/>
    					<? include('modules/parking_engine_campus.php'); ?>
    					<p style="padding-left: 10px;"><small>Figures are approximate and may fluctuate quickly.</small></p>
    				</div>
            	</div>
        	</div>
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h4 class="panel-title"><a data-toggle="collapse" href="#collapseSnowEmergency" id="tab252">Snow emergency status</a></h4>
	            </div>
	            <div id="collapseSnowEmergency" class="panel-collapse collapse <?=$toggle?>">
	                <div class="panel-body">
	                	<?=$snowEmergency?>
	                </div>
	            </div>
	        </div>
	</div>
	</div>
</div>
</div>