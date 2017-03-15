<?
include_once('functions.php');
$file = fopen(__DIR__."/../data/roads.txt", "r") or die("Unable to open file!");
$data = fread($file,filesize(__DIR__."/../data/roads.txt"));
fclose($file);
$start = '<span id="ctl00_ctl00_ContentPlaceHolder_Column2PlaceHolder_ListGridView_ctl03_CountyLabel">';
$stop = '</tr><tr class="pager">';
$winterroads = "<tr><td>".$start.scrape_between($data,$start,$stop)."</tr>";
?>
<a name="traffic"></a>
<div class="panel-group" id="masterGroupTraffic">
	<div class="panel panel-info d-shadow">
		<div class="panel-heading">
           <div class="panel-title">
           		<p><a data-toggle="collapse" href="#collapseTraffic" id="tab1">Traffic</a></p>
            </div>
		</div>
		<div id="collapseTraffic" class="panel-collapse collapse">
			<div class="panel-body">
				<div id="map-canvas"></div><!-- the google traffic map renders here -->
				<br/>
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h4 class="panel-title"><a data-toggle="collapse" href="#collapseOne" class="collapsed" id="subtab1">Interstate highway cameras</a></h4>
			            </div>
			            <div id="collapseOne" class="panel-collapse collapse">
			                <div class="panel-body">
								<!-- Interstate highway traffic cameras -->
								<img alt="camera image" class="img-responsive lazy" src="/data/cam9.jpg">								
								<img alt="camera image" class="img-responsive lazy" src="/data/cam10.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam11.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam12.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam13.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam14.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam15.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam16.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam17.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam18.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam19.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam20.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam21.jpg">
			                </div>
			            </div>
			        </div>
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h4 class="panel-title">
			                    <a data-toggle="collapse" href="#collapseTwo" class="collapsed" id="subtab2">City  street cameras</a>
			                </h4>
			            </div>
			            <div id="collapseTwo" class="panel-collapse collapse">
			                <div class="panel-body">
			                	<!-- City street cameras -->
								<img alt="camera image" class="img-responsive lazy" src="/data/cam22.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam23.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam24.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam25.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam26.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam27.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam28.jpg">
			                </div>
			            </div>
			        </div>
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h4 class="panel-title">
			                    <a data-toggle="collapse" href="#collapseThree" class="collapsed" id="subtab3">Beltline highway cameras</a>
			                </h4>
			            </div>
			            <div id="collapseThree" class="panel-collapse collapse">
			                <div class="panel-body">
			                	<!-- Beltline highway cameras -->
								<img alt="camera image" class="img-responsive lazy" src="/data/cam29.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam30.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam31.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam32.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam33.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam34.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam35.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam36.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam37.jpg">
								<img alt="camera image" class="img-responsive lazy" src="/data/cam38.jpg">
			            	</div>
			            </div>
			        </div>
					<div class="panel panel-default">
			            <div class="panel-heading">
			                <h4 class="panel-title">
			                    <a data-toggle="collapse" href="#collapseFive" class="collapsed" id="subtab4">@madisontraffic</a>
			                </h4>
			            </div>
			            <div id="collapseFive" class="panel-collapse collapse">
			                <div class="panel-body">
			        			<a class="twitter-timeline" href="https://twitter.com/madisontraffic" data-widget-id="557297612676939777">Tweets by @madisontraffic</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			        		</div>
			            </div>
			        </div>
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h4 class="panel-title">
			                    <a data-toggle="collapse" href="#collapseFour" class="collapsed" id="subtab5">Winter road conditions</a>
			                </h4>
			            </div>
			            <div id="collapseFour" class="panel-collapse collapse">
			                <div class="panel-body">
								<div class="table-responsive">
			                        <table class="table table-striped">
			                            <thead>
			                                <tr>
			                                    <th>County</th>
			                                    <th>Road</th>
			                                    <th>Stretch</th>
			                                    <th>Condition</th>
			                                    <th>Observed at</th>
			                                </tr>
			                            </thead>
			                            <tbody>
											<? echo $winterroads; ?>
			                            </tbody>
			                        </table>
			                    </div>
			                    <small><a href="http://www.511wi.gov/Web/traffic/winterroadconditions">http://www.511wi.gov/Web/traffic/winterroadconditions
								</a></small>
			            	</div>
			            </div>
			        </div>
			    
			</div>
		</div>
	</div>
</div>