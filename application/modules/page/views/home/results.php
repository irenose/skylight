<?php if( isset($used_search_form) && $used_search_form == TRUE && count($installer_search_array) == 0) { ?>
	<section id="installer-search" class="page-row page-row--tall reversed" data-wallpaper='{"file":"us-map", "ext":"png"}'>
		<?php
			$data['cta_type'] = 'long';
	    	$data['no_results_message'] = TRUE;
	    	echo $this->load->view('partials/_find-installer', $data);
		?>
	</section>
<?php } else if( isset($bad_installer_url) && $bad_installer_url == TRUE) { ?>
	<section id="installer-search" class="page-row page-row--tall reversed" data-wallpaper='{"file":"us-map", "ext":"png"}'>
		<?php
			$data['cta_type'] = 'long';
			$data['bad_installer_message'] = TRUE;
			if(isset($former_installer) && $former_installer == TRUE) {
				$data['former_installer_message'] = TRUE;
			}
		    echo $this->load->view('partials/_find-installer', $data);
		?>
	</section>
<?php } ?>

	<section>
		<?php if( isset($used_search_form) && $used_search_form == TRUE && count($installer_search_array) > 0) { ?>
		    <div class="page-row reversed" data-wallpaper='{"file":"us-map", "ext":"png"}'>
		        <header class="centered">
		            <h2 class="locator__heading normal-weight">
		                There are <span class="color-primary"><?=count($installer_search_array);?></span> Installers near <?=$search_zip_code?>
		                <a href="/" class="locator__heading__link">
		                    Change Location
		                </a>
		            </h2>
		        </header>
		    </div>
		<?php } ?>

		<?php if(isset($show_map_results) && $show_map_results == TRUE) { ?>
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
		            <div id="map" class="tabs-content__item" data-lat="<?=$installer_search_array[0]->latitude?>" data-long="<?=$installer_search_array[0]->longitude?>"><!-- map inserted here --></div>
		            <div id="list" class="push-top--half push-bottom--half tabs-content__item">
		                <div class="constrained">
		                    <ul class="slick" data-carousel-type="locator" data-equal-heights aria-labelledby="hank">
		                        <?php foreach ($installer_search_array as $installer): ?>
		                        <li class="slick__item">
		                            <div class="card shadowed">
		                                <div class="installer" data-coordinates='{"lat":<?=$installer->latitude?>, "lng":<?=$installer->longitude?>}' data-address="<?=urlencode($installer->address . ' ' . $installer->city . ' ' . $installer->state . ' ' . $installer->zip)?>">
		                                    <div class="card__body">
		                                        <img src="<?=asset_url('images/icon-pin-map.png')?>" class="icon-pin--fancy" aria-hidden="true">
		                                        <h3 class="installer__name normal-weight">
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
		                                        <a href="<?=base_url() . $installer->dealer_url?>" class="btn installer__link">
		                                            Visit Site
		                                        </a><br>
		                                        <div class="installer-product-category-links">
			                                        <?php
			                                        	$categories_array = $this->page_model->get_product_categories($installer->dealer_id, 'active');
														if(count($categories_array) > 0) {
															echo 'We offer the following products<br>';
															foreach($categories_array as $category) {
																echo '<a href="' . base_url() . $installer->dealer_url . '/products/category/' . $category->product_category_url . '">' . $category->product_category_name . '</a><br />';
															}

														}
													?>
												</div>
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

<?=$this->load->view('partials/_footer--search.php');?>
