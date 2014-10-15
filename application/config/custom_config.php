<?php

$config['db_table_prefix'] = 'boilerplate_';  //Prefix for table names for multiple installations in same database
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

$config['contact_form_recipient'] = '';
$config['contact_form_from'] = '';


$config['global_email_from'] = '';
$config['global_email_name'] = '';

$config['admin_client_logo'] = '';
$config['admin_client_name'] = 'BOILERPLATE';

$config['protected_file_dir'] = str_replace('public_html','',$_SERVER['DOCUMENT_ROOT']);

$config['content_images_dir'] = '/content-uploads/content-images/';
$config['content_images_full_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/content-uploads/content-images/';

$config['content_documents_dir'] = '/content-uploads/content-documents/';
$config['content_documents_full_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/content-uploads/content-documents/';

?>