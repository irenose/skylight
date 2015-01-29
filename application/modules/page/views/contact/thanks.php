<section class="page-row bg-grey promotions">
    <header class="intro-statement intro-statement--squeezed">
        <?php
            if(isset($form_status) && $form_status == 'success') {
                echo '<h1>Thank you for your request.</h1>';
                echo '<p>We will be in touch shortly.</p>';
            } else {
                echo '<h1>Error</h1>';
                echo '<p>There was a problem with your submission. Please call us at ' . $installer_array[0]->phone1 . ' to discuss your request.</p>';
            }
        ?>
    </header>
</section>