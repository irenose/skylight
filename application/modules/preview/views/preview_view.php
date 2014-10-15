<?php
/***************************************************************************************************
/*	WIREFRAME PAGE LAYOUT
***************************************************************************************************/
	
	if( isset($show_login) && $show_login == TRUE) {
		echo '<h1>';
		if( isset($login_header) && $login_header != '') {
			echo $login_header;
		} else {
			echo 'Please Log In Below';
		}
		echo '</h1>';
		echo '<div id="user_content" style="margin-bottom:0px;padding-bottom:10px;">';
		if( isset($login_copy) && $login_copy != '') {
			echo $login_copy;
		} else {
			//Generic Login Page copy
			echo 'Use the form below to log in';
		}
		echo '</div>';
		
		echo '<div id="login_form">';
		if(validation_errors()) {
			echo '<div class="error_list"><h1>There were problems with your submission</h1><ul>' . "\n";
    		echo validation_errors('<li>','</li>');
    		echo '</ul></div>' . "\n";
			
		}
		
		if( $this->session->flashdata('status_message') != '') {
			echo '<div class="error_list"><h1>' . $this->session->flashdata('status_message') . '</h1></div>';
			
		}
		echo form_open($hidden_input_array['page_url']);
		echo '<input type="hidden" name="page_id" value="' . $hidden_input_array['page_id'] . '">';
		echo '<div id="login_container">' . "\n";
		echo '<div id="form_inputs">' . "\n";
		echo '<input type="text" class="input_text" name="username" value="' . set_value('username') . '">';
		echo '<input type="password" class="input_text" name="password">';
		echo '</div>' . "\n"; //End form_inputs
		echo '<div id="submit_button">' . "\n";
		echo '<input type="image" src="/_assets/images/site/login_submit_btn.gif" value="log in">';
		echo '</div>' . "\n"; // End submit_button
		echo '</form>';
		echo '</div>';
		echo '</div>';
		
	} else {
		echo '<h1>' . $page_headline . '</h1>' . "\n";
		echo '<div id="user_content">' . "\n";
		echo $page_display;
		echo '<div class="clear"> </div>' . "\n";
		echo '</div>' . "\n";
		
		if( isset($is_404) && $is_404 == TRUE) {
			echo $sitemap;
		}
	}
