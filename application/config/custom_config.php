<?php

$config['db_table_prefix'] = 'ss_';  //Prefix for table names for multiple installations in same database
$config['use_cms'] = TRUE;
$config['static_site'] = FALSE;
$config['template_type'] = ''; //This defines whether to use the wireframe template ('wireframe') or the regular template ('template') as the view

$config['results_per_page'] = 10;
$config['admin_results_per_page'] = 20;

/********************************************************************
SALT IS ADDED TO PASSWORDS FOR THE HASH ON THE ADMIN INSTALLATION. YOU CAN CHANGE IT HERE DURING INSTALLATION, BUT IF YOU CHANGE IT AT ANY OTHER POINT, IT WILL INVALIDATE ANY PREVIOUS PASSWORDS
***********************************************************************/
/* DO NOT CHANGE ONCE SET!!  */  $config['salt'] = '@D8j77sadf^9021x&&10s3kxP!^db$';  //DO NOT CHANGE ONCE SET!!
/******* DID I MENTION NOT TO CHANGE THE SALT ONCE ITS SET?? *******************************/

$config['404_header'] = 'We\'re sorry, but the page you\'re looking for can\'t be found.';
$config['404_message'] = 'Below is the site map for our website. When you find what you\'re looking for, simply click on the link.';

$config['default_meta_array'] = array(
	'title' => 'Welcome',
	'description' => '',
	'keywords' => ''
);

$config['global_email_from'] = 'microsites@skylightspecialist.com';
$config['global_email_name'] = 'VELUX';

if(defined('ENVIRONMENT') && (ENVIRONMENT == 'staging' || ENVIRONMENT == 'development')) {
	//STAGING/DEVELOPMENT
	$config['site_status_recipient'] = 'dev@wrayward.com';
	$config['profile_updates_recipient'] = 'dev@wrayward.com';
} else {
	//PRODUCTION
	$config['site_status_recipient'] = 'stephanie@ravenelconsulting.com,jvoorhees@wrayward.com,dev@wrayward.com';
	$config['profile_updates_recipient'] = 'chan.hoyle@VELUX.com,jvoorhees@wrayward.com,michelle@ravenelconsulting.com,stephanie@ravenelconsulting.com,bettye.booker@VELUX.com,jhalpin@wrayward.com,dev@wrayward.com';

}

$config['admin_client_logo'] = '/src/admin/assets/images/velux_logo.png';
$config['admin_client_name'] = 'VELUX';

$config['protected_file_dir'] = str_replace('public_html','',$_SERVER['DOCUMENT_ROOT']);
$config['folder_chmod'] = 0777;
$config['file_chmod'] = 0777;

$config['content_images_dir'] = '/content-uploads/content-images/';
$config['content_images_full_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/content-uploads/content-images/';

$config['content_documents_dir'] = '/content-uploads/content-documents/';
$config['content_documents_full_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/content-uploads/content-documents/';

$config['gallery_images_dir'] = '/content-uploads/gallery-images/';
$config['gallery_images_full_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/content-uploads/gallery-images/';

$config['product_images_dir'] = '/content-uploads/product-images/';
$config['product_images_full_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/content-uploads/product-images/';

$config['promotion_files_dir'] = '/content-uploads/promotion-files/';
$config['promotion_files_full_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/content-uploads/promotion-files/';

$config['resources_dir'] = '/content-uploads/resources/';
$config['resources_full_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/content-uploads/resources/';

$config['dealer_assets_dir'] = '/content-uploads/dealer-assets/';
$config['dealer_assets_full_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/content-uploads/dealer-assets/';

$config['brochure_assets_dir'] = '/content-uploads/brochure-images/';
$config['brochure_assets_full_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/content-uploads/brochure-images/';

/*-----------------------
  @Upload Paths
------------------------*/
$config['gallery_images_upload_path'] = './content-uploads/gallery-images/';
$config['content_images_upload_path'] = './content-uploads/content-images/';
$config['content_documents_upload_path'] = './content-uploads/content-documents/';
$config['product_images_upload_path'] = './content-uploads/product-images/';
$config['promotion_files_upload_path'] = './content-uploads/promotion-files/';
$config['resources_upload_path'] = './content-uploads/resources/';
$config['dealer_assets_upload_path'] = './content-uploads/resources/';

/*-----------------------
  @Mandrill
  https://mandrillapp.com/settings/index/
------------------------*/
$config['mandrill_api_key'] = 'a2VX1IxxdKP5Ku5cGa0KsA';

?>