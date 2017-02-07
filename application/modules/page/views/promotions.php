<section class="page-row bg-grey promotions">
    <header class="intro-statement intro-statement--squeezed">
        <h1><?= $installer_array[0]->promotion_headline; ?></h1>
        <p><?= filter_page_content(nl2br($installer_array[0]->promotion_page_copy)); ?></p>
    </header>
</section>
