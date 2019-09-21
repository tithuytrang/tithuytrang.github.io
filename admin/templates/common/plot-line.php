<?php
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
<div class="container-plot-line">
	<canvas class="plot-canvas" height="110"></canvas>
	<script>
	var context = document.getElementsByTagName( "canvas" )[0].getContext( "2d" );	
	var chart = new Chart(context, {
		"type": "line",
		"data": {
			"labels": [
			<?php 
				$jsondata = "";
				// Find the longest dataset
				$longest = array();
				foreach ($datasets as $id => $dataset) {
					if (count($dataset) > count($longest)) {
						$longest = $dataset;
					}
				}
				foreach ($dataset as $x => $y) {
					$jsondata .= "\"" . $x . "\",";
				}
				echo trim($jsondata, ",");
			?>
			],
			"datasets": [
<?php $written = false; $i = 0; ?>
<?php foreach ($datasets as $id => $dataset): $i++; if ($written) { echo ","; } $written = true;?>
			{
				"label": "<?php echo $id ?>",
				"borderColor": "<?php echo $colors[$i % count($colors)] ?>",
				"backgroundColor": "<?php echo $bgcolors[$i % count($bgcolors)] ?>",
				"lineTension": 0, // Disable the bezier
				"spanGaps": true,
				"data": [
					<?php
					$jsondata = "";
					foreach($dataset as $x => $y) {
						$jsondata .= "{ x: \"" . $x . "\", y: " . $y . " },\n\t\t\t\t\t";
						if ($y > 1) {
							$float = true; // Ah! we'll correct the Y axes for float numbers
						}
					}
					echo trim($jsondata, ",");
					?>			
				]
			}
<?php endforeach; ?>
			]
		},
		"options": {
			"responsive": true,
			"legend": {
	            "display": <?php echo isset($legend) && !$legend ? "false" : "true" ?>,
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
