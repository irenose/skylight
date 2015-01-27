<!--<h1>Skylight Specialist Main Page</h1>
<form action="" method="post">
	<input type="hidden" name="installer_search" value="yes">
	<label>Zip Code</label>
	<input type="text" name="zip">
	<input type="submit" value="Find Installers">
</form>
-->
<section class="page-row page-row--extra-tall hero hero-search">
	<header class="intro-statement">
		<h1 class="reversed upper mega-heading">Bring the benefits of daylight home</h1>
	</header>
</section>
<section class="page-row">
	<header class="intro-statement intro-statement--squeezed bringing-daylight">
		<h2>Bringing daylight to life</h2>
		<p>For over 60 years, VELUX has designed energy-efficient daylighting solutions for commercial and residential buildings. By letting more daylight into your home, VELUX skylights help you use one of our most abundant natural resources, daylight, to illuminate and add drama to any room.</p>
	</header>
</section>

<section class="page-row page-row--tall reversed" data-wallpaper='{"file":"us-map", "ext":"png"}'>
<?php
	$data['cta_type'] = 'long';
    echo $this->load->view('partials/_find-installer', $data);
?>
</section>

<?php
	$data['hide_learn_more_links'] = TRUE;
	echo $this->load->view('partials/_products-short', $data);
?>

<?=$this->load->view('partials/_footer--search.php');?>