<?php $bazaar_product_id = 'prod-' . $product->product_id; ?>
<script type="text/javascript"> 
    $BV.configure('global', { productId : '<?=$bazaar_product_id?>'});
    $BV.ui( 'rr', 'show_reviews', {
        doShowContent : function () { 
        // If the container is hidden (such as behind a tab), put code here to make it visible 
        // (open the tab).
        }
    });
</script>
<div id="BVRRContainer"></div>