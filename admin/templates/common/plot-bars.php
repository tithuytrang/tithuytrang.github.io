<?php
	$float = false; // Used to check if the Y axes is going to be shown with float numbers
?>
<div class="container-plot-bars">
	<canvas class="plot-canvas" height="110"></canvas>
	<script>
	// The legend template is defined up above
	var context = document.getElementsByTagName( "canvas" )[0].getContext( "2d" );	
	var chart = new Chart(context, {
		"type": "bar",
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
			"datasets": [
				{
					"label": "",
					"backgroundColor": [
						"rgba(250,164,58,0.2)",
						"rgba(96,189,104,0.2)",
						"rgba(77,77,77,0.2)",
						"rgba(93,165,218,0.2)",
						"rgba(241,124,176,0.2)",
						"rgba(222,207,63,0.2)",
						"rgba(178,118,178,0.2)",
						"rgba(178,145,47,0.2)",
						"rgba(241,88,84,0.2)"
					],
					"borderColor": [
						"rgb(250,164,58)",
						"rgb(96,189,104)",
						"rgb(77,77,77)",
						"rgb(93,165,218)",
						"rgb(241,124,176)",
						"rgb(222,207,63)",
						"rgb(178,118,178)",
						"rgb(178,145,47)",
						"rgb(241,88,84)"
					],
					"data": [
						<?php
						$jsondata = "";
						foreach($data as $x => $y) {
							$jsondata .= $y . ",\n\t\t\t\t\t";
						}
						echo trim($jsondata, ",");
						?>			
					]
				}
			]
		},
		"options": {
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
