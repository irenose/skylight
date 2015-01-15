<div class="breadcrumb">
    <nav class="nav-breadcrumb">
    	<?php
            /*-------------------------------------------------------
                If Breadcrumb array exists, loop through and format
            -------------------------------------------------------*/
    		if( isset($breadcrumbs_array) && count($breadcrumbs_array) > 0) {
    			$count = 0;
    			foreach($breadcrumbs_array as $key => $breadcrumb) {
    				$count++;
    				$link = ($count == 1) ? '' : ' / ';
    				$link .= ($breadcrumb['url'] != '') ? '<a href="' . $breadcrumb['url'] . '">' . $breadcrumb['label'] . '</a>' : $breadcrumb['label'];
    				echo $link;
    			}
    		}
    	?>
    </nav>
    <div class="breadcrumb-links">
        <a href=<?php echo '"' . $installer_base_url . '/contact"'?> data-modal-open data-ajax-vars='{"view":"partials/_modal-content", "content-type":"contact"}'>Schedule a Consultation</a>
    </div>
</div>