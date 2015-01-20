<?php
	/*
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
	*/
?>
<section>
    <div class="page-row reversed" data-wallpaper='{"file":"us-map", "ext":"png"}'>
        <header class="centered">
            <h2 class="locator__heading">
                There are <span class="color-primary"><?=count($installer_search_array);?></span> Installers near <?=$search_zip_code?>
                <a href="<?=site_url()?>" class="locator__heading__link">
                    Change Location
                </a>
            </h2>
        </header>
    </div>
    <?php
    	if(count($installer_search_array) == 0) {
    		$data['cta_type'] = 'short';
    		echo $this->load->view('partials/_find-installer', $data);
    	} else {
    ?>
		    <script src="//maps.googleapis.com/maps/api/js?v=3.exp"></script>
		    <div class="bg-zircon" data-module="tabs">
		        <div class="thin-strip reversed">
		            <menu class="tabs-menu">
		                <a href="#map" class="btn-text-icon tabs-menu__link" role="button">
		                    <i class="icon icon-map" aria-hidden="true">
		                        <svg class="icon__svg">
		                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-map"></use>
		                        </svg>
		                    </i>
		                    Map View
		                </a>
		                <a href="#list" class="btn-text-icon tabs-menu__link" role="button" data-carousel-trigger id="hank">
		                    <i class="icon icon-list" aria-hidden="true">
		                        <svg class="icon__svg">
		                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-list"></use>
		                        </svg>
		                    </i>
		                    List View
		                </a>
		            </menu>
		        </div>
		        <div class="tabs-content">
		            <div id="search-map" class="tabs-content__item" data-lat="<?=$installer_search_array[0]->latitude?>" data-long="<?=$installer_search_array[0]->longitude?>"><!-- map inserted here --></div>
		            <div id="list" class="push-top--half tabs-content__item">
		                <div class="constrained">
		                    <ul class="slick" data-carousel-type="locator" data-equal-heights aria-labelledby="hank">
		                        <?php foreach ($installer_search_array as $installer): ?>
		                        <li class="slick__item">
		                            <div class="card shadowed">
		                                <div class="installer" data-coordinates='{"lat":<?=$installer->latitude?>, "lng":<?=$installer->longitude?>}' data-address="<?=urlencode($installer->address . ' ' . $installer->city . ' ' . $installer->state . ' ' . $installer->zip)?>">
		                                    <div class="card__body">
		                                        <img src="<?=asset_url('images/icon-pin--fancy.png')?>" class="icon-pin--fancy" aria-hidden="true">
		                                        <h3 class="installer__name">
		                                            <?=$installer->name?>
		                                        </h3>
		                                        <div class="installer__rating">

		                                        </div>
		                                        <div class="installer__address">
		                                            <?=$installer->address . '<br>' . $installer->city . ', ' . $installer->state . ' ' . $installer->zip?>
		                                        </div>
		                                        <div class="installer__phone">
		                                            <?=$installer->phone1?>
		                                        </div>
		                                    </div>
		                                    <footer class="no-border card__footer">
		                                        <a href="<?=base_url() . $installer->dealer_url?>" class="btn installer__link" target="_blank">
		                                            Visit Site
		                                        </a><br>
		                                        <?php
		                                        	$categories_array = $this->page_model->get_product_categories($installer->dealer_id, 'active');
													if(count($categories_array) > 0) {
														echo 'We offer the following products<br>';
														foreach($categories_array as $category) {
															echo '<a href="' . base_url() . $installer->dealer_url . '/products/category/' . $category->product_category_url . '">' . $category->product_category_name . '</a><br />';	
														}
														
													}
												?>
		                                    </footer>
		                                </div>
		                            </div>
		                        </li>
		                        <?php endforeach; ?>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div>
    <?php } ?>
</section>
