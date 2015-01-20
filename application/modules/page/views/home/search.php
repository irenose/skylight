<!--<h1>Skylight Specialist Main Page</h1>
<form action="" method="post">
	<input type="hidden" name="installer_search" value="yes">
	<label>Zip Code</label>
	<input type="text" name="zip">
	<input type="submit" value="Find Installers">
</form>
-->
<?php
	$data['cta_type'] = 'short';
    echo $this->load->view('partials/_find-installer', $data);
	echo $this->load->view('products/index');
?>
