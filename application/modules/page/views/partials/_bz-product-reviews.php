<?php 
	$bazaar_product_id = 'prod-' . $product->product_id; 
	require('bvseosdk.php');
    $bv = new BV(array(
	    'deployment_zone_id' => 'Main_Site-en_US',
	    'product_id' => $bazaar_product_id,
	    'cloud_key' => 'veluxskylightspecialist-0b39041bd92de8f2b6d3969d16e22882',
	    'current_page_url' => $bz_product_url,
    ));
?>
<script type="text/javascript"> 
    $BV.configure('global', { productId : '<?=$bazaar_product_id?>'});
    $BV.ui( 'rr', 'show_reviews', {
        doShowContent : function () { 
        // If the container is hidden (such as behind a tab), put code here to make it visible 
        // (open the tab).
        }
    });
</script>
<div id="BVRRContainer">
	<?php echo $bv->reviews->getReviews();?>
</div>