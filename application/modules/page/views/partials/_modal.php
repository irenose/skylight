<div class="modal" role="dialog" aria-is-hidden="true">
    <div class="modal__page">
        <header class="modal__header">
            <button title="Close" data-modal-close>
                <i class="icon icon-x">
                    <svg class="icon__svg">
                        <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-x"></use>
                    </svg>
                </i>
            </button>
        </header>
        <div class="modal__body">
            <h2 class="normal-weight">Contact <?=$installer_array[0]->name; ?></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
            <?= $this->load->view('partials/_contact-form') ?>
        </div>
    </div>
</div>
<div class="modal-screen"></div>