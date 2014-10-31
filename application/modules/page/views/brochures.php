<h1>Brochures</h1>
<?php
	if( isset($brochures_array) && count($brochures_array) > 0) {
		foreach($brochures_array as $brochure) {
			echo $brochure->name . '<br>' . $brochure->description . '<br><br>';
		}
	}
?>
