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
            <h1 class="normal-weight">Contact <?=$installer_array[0]->name; ?></h1>
            <p>How can we help? Let us know if we can answer any questions, or if you're ready to start transforming your home with the beauty of daylight and fresh air. We look forward to working with you, and giving you your own slice of the sky.</p>
            <?= $this->load->view('partials/_contact-form') ?>
        </div>
    </div>
</div>
<div class="modal-screen"></div>