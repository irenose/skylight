<?php
	//_a($installer_search_array);
	foreach($installer_search_array as $installer) {
		echo $installer->name . '<br>' . $installer->address . '<br>' . $installer->city . ', ' . $installer->state . ' ' . $installer->zip . '<br>';
		echo '<a href="' . base_url() . $installer->dealer_url . '">View Microsite</a><br><br>';
	}
