<?php
    $add_border_class = isset($add_leak_border) ? ' border-bottom-grey' : '';
    $add_cta_padding = isset($add_leak_cta) && $add_leak_cta == TRUE ? ' cta-padding' : '';
?>
<section class="page-row short-top snug-bottom ps-section no-leak-skylight">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet<?=$add_border_class . $add_cta_padding?>">
            <?=$this->load->view('partials/_svg-icon-no-leak.php');?>
            <h4 class="normal-weight underlined color-primary">The No Leak Skylight</h4>
            <p>With The No Leak Skylight, we promise you no leaks and no worries because our revolutionary product is built with three powerful layers of protection. That's why we offer a 10-year product and installation warranty.</p>
            <?php
            	if(isset($add_leak_cta) && $add_leak_cta == TRUE) {
            		echo $this->load->view('partials/_paid-search-call-cta');
            	}
            ?>
        </div>
    </div>
</section>