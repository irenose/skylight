<?php
	//_a($installer_search_array);
	if( isset($installer_search_array) && count($installer_search_array) > 0) {
		$total_results_label = count($installer_search_array) == 1 ? 'is 1 installer' : 'are ' . count($installer_search_array) . ' installers';
		echo '<h2>There ' . $total_results_label . ' near ' . $search_zip_code . '</h2>';

		foreach($installer_search_array as $installer) {
			echo $installer->name . '<br>' . $installer->address . '<br>' . $installer->city . ', ' . $installer->state . ' ' . $installer->zip . '<br>';
			echo '<a href="' . base_url() . $installer->dealer_url . '">View Microsite</a><br><br>';
		}
	} else {
		echo 'There are no installers in your area.';
	}
