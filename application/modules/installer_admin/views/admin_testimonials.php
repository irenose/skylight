<h1 class="clearfix">
    <div class="header_label">Testimonials</div>
    <div class="header_actions">
        <a href="/installer-admin/testimonials/add" class="header_action">Add Testimonial</a>
    </div>
</h1>
<p>Nothing boosts a potential customer's confidence than a testimonial from other customers. You may add a custom testimonial by clicking the "add testimonial" button above.</p>
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
<?php
    echo form_open('/installer-admin/testimonials');
    echo '<input type="hidden" name="dealer_id" value="' . $dealer_id . '">';
    $options_array = $this->installer_admin_model->get_dealer_options($dealer_id);
    $all_testimonials_array = array();
    if(trim($options_array[0]->testimonials) != '') {
        $inactive_array = explode(',',$options_array[0]->testimonials);
    } else {
        $inactive_array = array();
    }
?>
    <div id="action_form_wrapper">
        <div class="action_form">
            <?php
                
                echo '<h2>Custom Testimonials</h2>';
                echo '<p>Update your custom testimonials by clicking the "update" button next to each testimonial.</p>';
                if( isset($dealer_testimonials_array) && count($dealer_testimonials_array) > 0) {
                    $bg_color = 'gray';
                       
                    echo '<table class="list_table" cellpadding="0" cellspacing="0" border="0">';
                    echo '<tr>';
                    echo '<td width="10%" class="table_header"><span class="table_header_text">SHOW</span></td>';
                    echo '<td width="50%" class="table_header"><span class="table_header_text">TESTIMONIAL</span></td>';;
                    echo '<td class="table_header"><span class="table_header_text">ACTIONS</span></td>';
                    echo '</tr>';
                    foreach($dealer_testimonials_array as $testimonial) {
                        $bg_color = $bg_color == 'white' ? 'gray' : 'white';
                        $all_testimonials_array[] = $testimonial->testimonial_id;
                        if(in_array($testimonial->testimonial_id,$inactive_array)) {
                            $checked = '';
                        } else {
                            $checked = ' checked="checked"';    
                        }
                        
                        echo '<tr class="' . $bg_color . '">' . "\n";
                        echo '<td width="10%" class="td_border"><input type="checkbox" name="velux_testimonials[]" value="' . $testimonial->testimonial_id . '"' . $checked . '></td>' . "\n";
                        echo '<td width="50%" class="td_border">' . $testimonial->testimonial_copy . '</td>' . "\n";
                        echo '<td class="td_border"><a href="/installer-admin/testimonials/update/' . $testimonial->testimonial_id . '" class="list_action">Update</a> <a href="/installer-admin/testimonials/delete/' . $testimonial->testimonial_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
                        echo '</tr>' . "\n";    
                    }
                    echo '</table>';
                } else {
                    echo '<p>You have no custom testimonials. <a href="/installer-admin/testimonials/add">Add one now</a></p>';   
                }
                
                echo '<div class="form_spacer"> </div>';
                echo '<h2>VELUX Testimonials</h2>';
                echo '<p>VELUX has provided you with pre-set customer testimonials that will appear on select pages of your site. Check the boxes next to the testimonials that you want to appear on your site. Remember to click the "update testimonials" button at the bottom of the page to save your changes.</p>'; 
                if( isset($velux_testimonials_array) && count($velux_testimonials_array) > 0) {
                    echo '<table class="list_table" cellpadding="0" cellspacing="0" border="0">';
                    echo '<tr>';
                    echo '<td width="10%" class="table_header"><span class="table_header_text">SHOW</span></td>';
                    echo '<td class="table_header"><span class="table_header_text">TESTIMONIAL</span></td>';;
                    echo '</tr>';
                    foreach($velux_testimonials_array as $testimonial) {
                        $bg_color = 'white';
                        $all_testimonials_array[] = $testimonial->testimonial_id;
                        if(in_array($testimonial->testimonial_id,$inactive_array)) {
                            $checked = '';
                        } else {
                            $checked = ' checked="checked"';    
                        }
                        
                        echo '<tr class="' . $bg_color . '">' . "\n";
                        echo '<td width="10%" class="td_border"><input type="checkbox" name="custom_testimonials[]" value="' . $testimonial->testimonial_id . '"' . $checked . '></td>' . "\n";
                        echo '<td class="td_border">' . $testimonial->testimonial_copy . '</td>' . "\n";
                        echo '</tr>' . "\n";
                    }
                    echo '</table>';
                }
                $counter = 0;
                $all_testimonials = '';
                foreach($all_testimonials_array as $key => $value) {
                    $counter++;
                    if($counter == 1) {
                        $all_testimonials .= $value;
                    } else {
                        $all_testimonials .= ',' . $value;
                    }
                }
                echo '<input type="hidden" name="all_testimonials_list" value="' . $all_testimonials . '">';
            ?>
            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_testimonials" rel="update_testimonials" value="Update Testimonials" class="submit" /><a href="/installer-admin/home" class="cancel_button">Cancel</a>
            </div>
        </div>
    </div>
</form>
