<div id="analytics-dates" class="date-picker">
	<div class="input-wrapper border border-mute-light">
		<input type="text" id="from" class="border border-mute-light background-transparent" />	
		<span class="fa fa-calendar"></span>
	</div>
	<div class="input-wrapper border border-mute-light">
		<input type="text" id="to" class="border border-mute-light background-transparent" />
		<span class="fa fa-calendar"></span>
	</div>
</div>
<script>
	// Init the datepicker fields
	x5engine.boot.push(function() {
		var from = x5engine.imDatePicker( $("#from"), {
			"icon"       : false,
			"date"       : new Date(<?php echo isset($_GET['from']) ? $_GET['from'] : date("U", strtotime("-1 month")) . " * 1000" ?>),
			"setInitial" : true,
			"onChange"   : function () {
				if (from.date() < to.date()) {
					location.href="<?php echo $baseUrl ?>from=" + from.date().getTime() + "&to=" + to.date().getTime();
				}
			}
		});
		var to = x5engine.imDatePicker( $("#to"), {
			"icon"       : false,
			"date"       : new Date(<?php echo isset($_GET['to']) ? $_GET['to'] : "" ?>),
			"setInitial" : true,
			"onChange"   : function () {
				if (to.date() > from.date()) { 
					location.href="<?php echo $baseUrl ?>from=" + from.date().getTime() + "&to=" + to.date().getTime();
				}
			}
		});
	});
</script>
