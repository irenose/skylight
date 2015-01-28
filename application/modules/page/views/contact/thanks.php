<section class="page-row bg-grey promotions">
    <header class="intro-statement intro-statement--squeezed">
    	<?php
    		if(isset($form_status) && $form_status == 'success') {
    			echo '<h1>Thank You</h1>';
    			echo '<p>Thank you copy goes here</p>';
    		} else {
    			echo '<h1>Error</h1>';
    			echo '<p>There was a problem. Call us at ' . $installer_array[0]->phone1 . '</p>';
    		}
    	?>
    </header>
</section>