<div id="list_page_header">
    <h1 class="news_header">LITERATURE</h1>
</div>
<div class="flashdata">
    <?php 
        if(validation_errors()) {
            echo '<div class="error_alert">' . "\n";
            echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
            echo '</div>' . "\n";
        }
        if(isset($error)) {
            echo $error;
        }
        echo $this->session->flashdata('status_message');
    ?>
</div>
<div class="clear" style="height:20px;"> </div>
<div id="instruction_copy">
    <p>We have provided a selection of brochures, downloadable in PDF format, for customers to learn more about VELUX products. Check the boxes next to the brochures you want your customers to be able to download from your microsite. Remember to click the blue "update literature" button at the bottom of this page to save your changes.</p>
</div>
<?php
    echo form_open('dealer-admin/literature');
    echo '<input type="hidden" name="dealer_id" value="' . $dealer_id . '">';
    $options_array = $this->dealer_admin_model->get_dealer_options($dealer_id);
    $all_brochures_array = array();
    if(trim($options_array[0]->literature) != '') {
        $inactive_array = explode(',',$options_array[0]->literature);
    } else {
        $inactive_array = array();
    }
    if( isset($literature_array) && count($literature_array) > 0) {
        $bg_color = 'gray';
           
        echo '<table class="users_list_table" cellpadding="0" cellspacing="0" border="0">';
        echo '<tr>';
        echo '<td width="50" class="table_header"><span class="table_header_text">SHOW</span></td>';
        echo '<td width="150" class="table_header"><span class="table_header_text">IMAGE</span></td>';
        echo '<td class="table_header"><span class="table_header_text">BROCHURE NAME</span></td>';
        echo '</tr>';
        foreach($literature_array as $brochure) {
            $bg_color = $bg_color == 'white' ? 'gray' : 'white';
            $all_brochures_array[] = $brochure->literature_id;
            if(in_array($brochure->literature_id,$inactive_array)) {
                $checked = '';
            } else {
                $checked = ' checked="checked"';    
            }
            
            echo '<tr class="' . $bg_color . '">' . "\n";
            echo '<td width="50" class="td_border"><input type="checkbox" name="literature[]" value="' . $brochure->literature_id . '"' . $checked . '></td>' . "\n";
            echo '<td class="td_border"><img src="/downloads/thumbs/' . $brochure->thumbnail . '.' . $brochure->thumbnail_extension . '" width="75" border="0"></td>' . "\n";
            echo '<td class="td_border">' . $brochure->name . '</td>' . "\n";
            echo '</tr>' . "\n";    
        }
        echo '</table>';
    } else {
        echo 'There are no brochures.'; 
    }
    
    $counter = 0;
    $all_brochures = '';
    foreach($all_brochures_array as $key => $value) {
        $counter++;
        if($counter == 1) {
            $all_brochures .= $value;
        } else {
            $all_brochures .= ',' . $value;
        }
    }
    echo '<input type="hidden" name="all_brochures_list" value="' . $all_brochures . '">';
?>  
    <div class="form_clear"> </div>
    <div id="form_submit_options">
        <div id="submit_options">
            <input type="image" src="/_assets/images/admin/default/buttons/update_literature_btn.gif" />
        </div>
        <div class="clear"> </div>
    </div>
    </form>
    <div class="form_clear"> </div>
