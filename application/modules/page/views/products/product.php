<?php 
    /******************************* BREADCRUMB *************************/ 
?>
<?=$this->load->view('partials/_breadcrumb')?>
<section>
	LIFESTYLE IMAGE
	<?php 
		/*
			PRODUCT IMAGE URLS ARE AS FOLLOWS:

			PRODUCT IMAGE:
			$this->config->item('product_images_dir') . $product_info_array[0]->product_image . '.' . $product_info_array[0]->extension;

			LIFESTYLE IMAGE:
			$this->config->item('product_images_dir') . $product_info_array[0]->lifestyle_image . '.' . $product_info_array[0]->lifestyle_extension;
		*/
	?>
</section>
<section>
	<h1><?= filter_page_content($product_info_array[0]->product_name); ?></h1>
	<?= filter_page_content($product_info_array[0]->product_description); ?>
	<p><a href="">Contact Us (Modal)</a>
</section>
<section>
	FEATURE HEADLINE - TBD IF STATIC OR NOT
</section>
<section>
	FEATURE HEADLINE - TBD IF STATIC OR NOT
</section>
<section>
	FEATURE HEADLINE - TBD IF STATIC OR NOT
</section>
<section>
	FEATURE HEADLINE - TBD IF STATIC OR NOT
</section>
<section>
	RATINGS
</section>