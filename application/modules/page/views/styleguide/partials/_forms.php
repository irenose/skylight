<?php
$inputs = [
    'text' => [
        [
            'type' => 'text',
            'placeholder' => 'Steve Sanders',
            'label' => 'Name',
            'required' => true,
        ],
        [
            'type' => 'tel',
            'placeholder' => '555-123-4567',
            'label' => 'Phone',
        ],
        [
            'type' => 'email',
            'placeholder' => 'name@email.com',
            'label' => 'Email',
        ],
        [
            'type' => 'url',
            'placeholder' => 'http://disney.com',
            'label' => 'Website',
        ],
        [
            'type' => 'password',
            'placeholder' => 's3cr3t',
            'label' => 'Password',
        ],
        [
            'type' => 'search',
            'placeholder' => 'donkeys',
            'label' => 'Enter Search Term',
        ],
        [
            'type' => 'file',
            'label' => 'Upload File',
        ],
    ],
    'textarea' => [
        [
            'type' => 'textarea',
            'label' => 'Comments',
        ],
    ],
    'optioned' => [
        [
            'type' => 'checkbox',
            'label' => 'Checkbox',
            'options' => [
                'a',
                'b',
                'c',
            ],
        ],
        [
            'type' => 'radio',
            'label' => 'Radio',
            'options' => [
                'a',
                'b',
                'c',
            ],
        ],
    ],
    'select' => [
        [
            'type' => 'select',
            'label' => 'Select Menu',
            'options' => [
                'a',
                'b',
                'c',
            ],
        ],
    ],
];
?>

<!-- TEXT -->
<?php foreach ($inputs['text'] as $_k => $_v): ?>
<?=styleguide_heading('sub', 'Input ('.$_v['type'].')')?>
<div class="form__field">
    <label for="<?=$_v['type']?>">
        <?=$_v['label']?><?=( array_key_exists('required', $_v) ? '<abbr title="Required" class="asterisk">*</abbr>' : null )?>
    </label>
    <input type="<?=$_v['type']?>" id="<?=$_v['type']?>" value="" <?=( array_key_exists('placeholder', $_v) ? 'placeholder="ex: '.$_v['placeholder'].'"' : null )?> <?=( array_key_exists('required', $_v) ? 'required' : null )?>>
</div>
<?php endforeach; ?>

<!-- TEXTAREA -->
<?php foreach ($inputs['textarea'] as $_k => $_v): ?>
<?=styleguide_heading('sub', 'Input ('.$_v['type'].')')?>
<div class="form__field">
    <label for="<?=$_v['type']?>">
        <?=$_v['label']?>
    </label>
    <textarea name="<?=$_v['type']?>" id="<?=$_v['type']?>" value=""></textarea>
</div>
<?php endforeach; ?>

<!-- CHECKBOX / RADIO -->
<?php foreach ($inputs['optioned'] as $_k => $_v): ?>
<?=styleguide_heading('sub', 'Input ('.$_v['type'].' - vertical)')?>
<div class="form__field">
    <?php foreach ($_v['options'] as $_o): ?>
    <div class="field__<?=$_v['type']?>--vertical">
        <label for="<?=$_v['type']?>-<?=$_o?>">
            <?=$_v['label']?> <?=ucfirst($_o)?>
            <input type="<?=$_v['type']?>" name="<?=$_v['type']?>" id="<?=$_v['type']?>-<?=$_o?>" value="">
        </label>
    </div>
    <?php endforeach; ?>
</div>
<?=styleguide_heading('sub', 'Input ('.$_v['type'].' - horizontal)')?>
<div class="form__field">
    <?php foreach ($_v['options'] as $_o): ?>
    <div class="field__<?=$_v['type']?>--horizontal">
        <label for="<?=$_v['type']?>-<?=$_o?>">
            <?=$_v['label']?> <?=ucfirst($_o)?>
            <input type="<?=$_v['type']?>" name="<?=$_v['type']?>" id="<?=$_v['type']?>-<?=$_o?>" value="">
        </label>
    </div>
    <?php endforeach; ?>
</div>
<?php endforeach; ?>

<!-- SELECT -->
<?php foreach ($inputs['select'] as $_k => $_v): ?>
<?=styleguide_heading('sub', 'Input ('.$_v['type'].')')?>
<div class="form__field">
    <label for="<?=$_v['type']?>">
        <?=$_v['label']?>
    </label>
    <select name="<?=$_v['type']?>" id="<?=$_v['type']?>">
        <option value="default" selected>Please select</option>
        <?php foreach ($_v['options'] as $_o): ?>
        <option value="option-<?=$_o?>">
            Option <?=ucfirst($_o)?>
        </option>
        <?php endforeach; ?>
    </select>
</div>
<?php endforeach; ?>