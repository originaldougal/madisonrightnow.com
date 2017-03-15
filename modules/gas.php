<?php
include_once('functions.php');
$data = getResource('http://www.madisongasprices.com/index.aspx?fuel=A', 'gas.txt');
$raw_report = scrape_between($data,'<tr id="rrlow_0" sm="0" ph="156315">','<td class="fts">');
?>

<a name="gas"></a>
<div class="panel-group" id="masterGroupGas">
	<div class="panel panel-info">
		<div class="panel-heading">
	           <div class="panel-title">
	           		<p><a data-toggle="collapse" data-parent="#masterGroupGas" href="#collapseGas" id="tab6" class="collapsed">Gas Prices</a></p>
	            </div>
		</div>
		<div id="collapseGas" class="panel-collapse collapse">
		    <div class="panel-body">
				<? echo $raw_report; ?>

		    </div>
	    </div>
	</div>
</div>