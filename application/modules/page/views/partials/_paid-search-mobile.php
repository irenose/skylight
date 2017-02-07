<div class="ps-mobile-wrapper">
    <div class="ps-bar<?php if(isset($paid_search_page_type) && $paid_search_page_type != 'night') { echo ' ps-bar-day"'; } ?>">
        <span class="reversed">Get In Touch With Us</span>
        <span class="icon-plus">+</span>
    </div>
    <div class="ps-mobile-form-wrapper">
        <div class="ps-mobile-form">
            <i class="icon icon-x ps-mobile-form-close">
                <svg class="icon__svg">
                    <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-x"></use>
                </svg>
            </i>
            <?php
                $data['modal_form'] = TRUE;
                $this->load->view('partials/_paid-search-form',$data);
            ?>
        </div>
    </div>
</div>