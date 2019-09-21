<?php
	$id = md5($title);
	$colors = array(
		"rgb(250,164,58)",
		"rgb(96,189,104)",
		"rgb(77,77,77)",
		"rgb(93,165,218)",
		"rgb(241,124,176)",
		"rgb(222,207,63)",
		"rgb(178,118,178)",
		"rgb(178,145,47)",
		"rgb(241,88,84)"
	);
	$bgcolors = array(
		"rgba(250,164,58,0.2)",
		"rgba(96,189,104,0.2)",
		"rgba(77,77,77,0.2)",
		"rgba(93,165,218,0.2)",
		"rgba(241,124,176,0.2)",
		"rgba(222,207,63,0.2)",
		"rgba(178,118,178,0.2)",
		"rgba(178,145,47,0.2)",
		"rgba(241,88,84,0.2)"
	);
	$float = false; // Used to check if the Y axes is going to be shown with float numbers
?>
<div>
	<div class="subtitle text-center" style="color: <?php echo $colors[$colorIndex] ?>;"><?php echo $title ?></div>
	<div class="simple-plot-container">
		<canvas class="simple-plot-canvas" id="<?php echo $id ?>" height="110"></canvas>
	</div>
	<script>
	// The legend template is defined up above
	var context = document.getElementById( "<?php echo $id ?>" ).getContext( "2d" );	
	var chart = new Chart(context, {
		"type": "<?php echo $type ?>",
		"data": {
			"labels": [
			<?php 
				$jsondata = "";
				foreach ($data as $x => $y) {
					$jsondata .= "\"" . $x . "\",";
				}
				echo trim($jsondata, ",");
			?>
			],
			"xLabels": [
			<?php 
				$jsondata = "";
				foreach ($data as $x => $y) {
					$jsondata .= "\"\",";
				}
				echo trim($jsondata, ",");
			?>
			],
			"datasets": [{
				"label": "<?php echo $title ?>",
				"borderColor": "<?php echo $colors[$colorIndex] ?>",
				"lineTension": 0, // Disable the bezier
				"spanGaps": true,
				"fill": false,
				"data": [
					<?php
					$jsondata = "";
					foreach($data as $x => $y) {
						$jsondata .= "{ x: \"" . $x . "\", y: " . $y . " },\n\t\t\t\t\t";
						if ($y > 1) {
							$float = true; // Ah! we'll correct the Y axes for float numbers
						}
					}
					echo trim($jsondata, ",");
					?>			
				]
			}]
		},
		"options": {
			"maintainAspectRatio": false,
			"responsive": true,
			"legend": {
	            "display": false
	        },
			"scales": {
	            "xAxes": [{
	                "gridLines": {
			        	"display": false
			        }
	            }],
	            "yAxes": [{
	                "gridLines": {
	                    "display":false
	                }
	                <?php if (!$float): ?>
	                ,"ticks": {
	                	"fixedStepSize": 1 // If we're in float risk, force the integer scale
	                }
	                <?php endif; ?>
	           	}]
	        }
		}
	});
	</script>
</div>
