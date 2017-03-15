<? include_once('functions.php'); ?>

<div class="panel panel-default d-shadow" style="border-color: #5D9EC2;">
    <div class="panel-heading">
		<a onclick="window.location.reload()" style="text-decoration: none;">
			<h2 class="shadowed-title"><strong>Madison</strong><span class="jazzy">Right</span>Now</h2>
			<p style="font-weight:normal;margin-bottom:10px;">on <? echo date("l")." at ".date("g:i A")." CST"; if(freshness() == true){echo '<small>.</small>';}?></p>
		</a>
		<div class="btn-group" role="group" style="margin-bottom: 10px; width:100%">
			<!-- disabled 11-19-15 idk y no work on desktop chrome
			
			<a id="openButton" onclick="#" role="button" class="btn btn-linkedin" style="width:33%"><i class="fa fa-plus-square"></i> <small>open all</small></a>
			<a id="closeButton" onclick="#" role="button" class="btn btn-linkedin" style="width:33%"><i class="fa fa-minus-square"></i> <small>close all</small></a> --> 
			<a onclick="window.location.reload();" role="button" class="btn btn-linkedin" style="width:100%"><i class="fa fa-refresh"></i></a>
		</div>
    </div>
</div>