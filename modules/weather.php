<?php
include_once('functions.php');

// 10-day forecast format from json file 3/14/2015 epic pi day

$file = fopen(__DIR__."/../data/forecast.json", "r") or die("Unable to open file!");
$data = fread($file,filesize(__DIR__."/../data/forecast.json"));
fclose($file);

$forecast = json_decode($data,true);

$forecastToday = $forecast[forecast][txt_forecast][forecastday][0][fcttext];
$forecastTodayIcon = $forecast[forecast][txt_forecast][forecastday][0][icon_url];

$forecastOutput = '';
for($i=0;$i<=19;$i++){
	$periodTitle = $forecast[forecast][txt_forecast][forecastday][$i][title];
	$periodIcon = $forecast[forecast][txt_forecast][forecastday][$i][icon];
	$periodIconURL = $forecast[forecast][txt_forecast][forecastday][$i][icon_url];
	$periodfcttext = $forecast[forecast][txt_forecast][forecastday][$i][fcttext];
	$forecastOutput .= "<h4>$periodTitle</h4><p><img class=\"lazy\" src=\"$periodIconURL\" alt=\"$periodIcon\"><br/>$periodfcttext</p><hr/>";
}

// hourly forecast format from json file 3/15/2015 st. patrick's day parade and saw Book of Mormon

$file = fopen(__DIR__."/../data/hourlyForecast.json", "r") or die("Unable to open file!");
$data = fread($file,filesize(__DIR__."/../data/hourlyForecast.json"));
fclose($file);

$hourlyForecast = json_decode($data,true);

// var_dump($hourlyForecast);

$hourlyForecastOutput = '';
//for($i=0;$i<=sizeof($hourlyForecast[hourly_forecast]);$i++){
for($i=0;$i<=11;$i++){
	$periodTitle = $hourlyForecast[hourly_forecast][$i][FCTTIME][civil];
	$periodWeekdayName = $hourlyForecast[hourly_forecast][$i][FCTTIME][weekday_name];
	if (isset($hourlyForecast[hourly_forecast][$i][condition][icon])) {
		$periodIcon = $hourlyForecast[hourly_forecast][$i][condition][icon];
	}
	$periodIconURL = $hourlyForecast[hourly_forecast][$i][icon_url];
	$periodfcttext = $hourlyForecast[hourly_forecast][$i][wx];
	$periodTemp = $hourlyForecast[hourly_forecast][$i][temp][english];
	$periodTempMetric = $hourlyForecast[hourly_forecast][$i][temp][metric];
	$hourlyForecastOutput .= "<h4>$periodTitle $periodWeekdayName</h4><p><img class=\"lazy\" src=\"$periodIconURL\" alt=\"$periodIcon\"><br/>$periodfcttext $periodTemp&deg;F / $periodTempMetric&deg;C</p><hr/>";
}


// ------- astro ------------ April 8, 2015

$file = fopen(__DIR__."/../data/astro.json", "r") or die("Unable to open astro JSON file!");
$data = fread($file,filesize(__DIR__."/../data/astro.json"));
fclose($file);
$astro = json_decode($data,true);
$astroOutputSunrise = $astro[moon_phase][sunrise][hour].":".$astro[moon_phase][sunrise][minute]." AM";
$astroOutputSunset = ($astro[moon_phase][sunset][hour]-12).":".$astro[moon_phase][sunset][minute]." PM";
$astroOutputMoon = $astro[moon_phase][percentIlluminated];

?>
<a name="weather"></a>
<div class="panel-group" id="masterGroupWeather">
	<div class="panel panel-info d-shadow">
	    <div class="panel-heading">
           <div class="panel-title">
           		<p><a data-toggle="collapse" data-parent="#masterGroupWeather" href="#collapseWeather" id="tab2">Weather</a></p>
            </div>
	    </div>
	    <div id="collapseWeather" class="panel-collapse collapse">
		    <div class="panel-body">
	    		<!-- <a href="http://www.wunderground.com/cgi-bin/findweather/getForecast?query=zmw:53701.1.99999&amp;bannertypeclick=wu_clean2day" title="Madison, Wisconsin Weather Forecast">
	    		<img alt="current weather" class="lazy img-responsive" src="http://weathersticker.wunderground.com/weathersticker/cgi-bin/banner/ban/wxBanner?bannertype=wu_clean2day_both_cond&amp;airportcode=KMSN&amp;ForcedCity=Madison&amp;ForcedState=WI&amp;zip=53701&amp;language=EN" alt="Find more about Weather in Madison, WI" /></a>
	                -->
	                
	                <a href="http://www.accuweather.com/en/us/madison-wi/53715/weather-forecast/331530" class="aw-widget-legal">

					</a><div id="awcc1478845362737" class="aw-widget-current"  data-locationkey="331530" data-unit="f" data-language="en-us" data-useip="false" data-uid="awcc1478845362737"></div><script async type="text/javascript" src="http://oap.accuweather.com/launch.js"></script>
	                
	                <p><strong>Today</strong>: <img src="<?=$forecastTodayIcon?>"><?=$forecastToday ?></p>
	               	<div class="panel-group" id="masterGroupWeatherSub">

	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <h4 class="panel-title">
	                            <a data-toggle="collapse" href="#collapseOneOne" data-parent="#masterGroupWeatherSub" id="tab201">Radar</a>
	                        </h4>
	                    </div>
	                    <div id="collapseOneOne" class="panel-collapse collapse">
	                    <div class="panel-body">
	    						<img alt="radar image" class="lazy img-responsive" src="http://radblast.wunderground.com/cgi-bin/radar/WUNIDS_map?station=MKX&amp;brand=wui&amp;num=1&amp;delay=15&amp;type=N0R&amp;frame=0&amp;scale=1.000&amp;noclutter=0&amp;lat=43.07297897&amp;lon=-89.38169861&amp;label=Madison%2C+WI&amp;showstorms=0&amp;map.x=400&amp;map.y=240&amp;centerx=400&amp;centery=240&amp;transx=0&amp;transy=0&amp;showlabels=1&amp;severe=0&amp;rainsnow=0&amp;lightning=0&amp;smooth=0">
	                        </div>
	                    </div>
	                </div>
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                    	<h4 class="panel-title">
	                            <a data-toggle="collapse" href="#collapseOneTwo" id="tab202">Hourly Forecast</a>
	                        </h4>
	                    </div>
	                    <div id="collapseOneTwo" class="panel-collapse collapse">
	                        <div class="panel-body">
								<ul style="list-style-type: none; padding-left: 0px;"><?echo $hourlyForecastOutput; ?></ul>
	                        </div>
	                    </div>
	                </div>	           
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                    	<h4 class="panel-title">
	                            <a data-toggle="collapse" href="#collapseOneThree" id="tab203">10 Day Forecast</a>
	                        </h4>
	                    </div>
	                    <div id="collapseOneThree" class="panel-collapse collapse">
	                        <div class="panel-body">
								<ul style="list-style-type: none; padding-left: 0px;"><?echo $forecastOutput; ?></ul>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                    	<h4 class="panel-title">
	                            <a data-toggle="collapse" href="#collapseOneFour" id="tab204">Sun &amp; Moon</a>
	                        </h4>
	                    </div>
	                    <div id="collapseOneFour" class="panel-collapse collapse">
	                        <div class="panel-body">
		                        <table cellpadding="10px">
		                        	<tr>
										<td><img src="data/images/sunrise.gif" width="44" height="32">&nbsp;</td>
										<td>Sunrise at <?=$astroOutputSunrise?></td>
									</tr>
									<tr>
										<td><img src="data/images/sunset.gif" width="44" height="32">&nbsp;</td>
										<td>Sunset at <?=$astroOutputSunset?></td>
									<tr>
									
										<td><img src="data/images/moon.gif" width="27" height="29">&nbsp;</td>
										<td>Moon is <?=$astroOutputMoon?>% illuminated</td>
									</tr>
								</table>
	                        </div>
	                    </div>
	                </div>	                
				</div>
			</div>
		</div>
	</div>
</div>