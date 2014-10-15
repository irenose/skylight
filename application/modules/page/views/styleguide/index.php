<?php
function styleguide_heading($type = '', $text = '', $href = '') {
    if ($type == 'main') {
        echo '<h1 class="styleguide__heading"><a href="'.$href.'">'.$text.'</a></h1>';
    } else {
        echo '<h2 class="styleguide__'.$type.'heading">'.$text.'</h2>';
    }
}

$partials = [
    'colors',
    'headings',
    'paragraphs',
    'links',
    'lists',
    'buttons',
    'forms',
    'blockquotes',
    'icons',
    'code',
];

$single = $this->uri->segment(2);
?>

<?php if ($single): ?>
    <section class="styleguide__block">
        <?=$this->load->view('styleguide/partials/_' . $single)?>
        <div class="styleguide__back">
            <a href="<?=site_url('styleguide')?>">Back to Index</a>
        </div>
    </section>
<?php else: ?>
    <?php foreach ($partials as $_k): ?>
    <section class="styleguide__block">
        <?=styleguide_heading('main', ucfirst($_k), site_url('styleguide/' . $_k))?>
        <?=$this->load->view('styleguide/partials/_' . $_k)?>
    </section>
    <?php endforeach; ?>
<?php endif; ?>
