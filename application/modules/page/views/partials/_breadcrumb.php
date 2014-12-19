<div class="breadcrumb">
    <nav class="nav-breadcrumb">
    	<?php
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
        <a>Schedule a Consultation</a>
        <a><span class="dotted">Have Questions or Comments?</span></a>
    </div>
</div>