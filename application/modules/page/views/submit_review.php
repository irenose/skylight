<?=$this->load->view('partials/_bz-javascript-init')?>
<script>
	$BV.ui('rr', 'submit_generic', {});

	function submit_review() {
       $BV.ui('rr', 'submit_generic', {});
    }
    
</script>
<section class="page-row bg-grey promotions">
    <header class="intro-statement intro-statement--squeezed">
        <h1 class="normal-weight">Own a VELUX skylight?</h1>
        <p><a onclick="submit_review();" href="#" class="cta-text">Write a review!</a></p>
    </header>
</section>
<?=$this->load->view('partials/_footer--search.php');?>