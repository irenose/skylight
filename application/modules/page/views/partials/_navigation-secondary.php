<?php
	if( isset($secondary_nav_array) && count($secondary_nav_array) > 0) {
		echo '<div class="thin-strip">' . "\n";
			echo '<nav class="nav-secondary" role="navigation" data-anchors-to-options>' . "\n";
			foreach($secondary_nav_array as $key => $nav) {
				echo '<a href="' . $nav['anchor'] . '" class="nav-secondary__link" data-btn-scroll>' . $nav['label'] . '</a>';
			}
			echo '</nav>' . "\n";
		echo '</div>' . "\n";
	}
?>