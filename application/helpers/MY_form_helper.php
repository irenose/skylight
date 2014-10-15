<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
if( ! function_exists('error_class')) {
	
	function error_class($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->errorClass($field);
	}
}

if( ! function_exists('form_input_error')) {
	
	function form_input_error($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->formInputError($field);
	}
}

if( ! function_exists('required_text')) {
	
	function required_text($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->requiredText($field);
	}
}

if( ! function_exists('form_dropdown_error')) {
	
	function form_dropdown_error($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->formDropdownError($field);
	}
}

if( ! function_exists('form_textarea_error')) {
	
	function form_textarea_error($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->formTextareaError($field);
	}
}

if( ! function_exists('textarea_error_class')) {
	
	function textarea_error_class($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->textareaErrorClass($field);
	}
}

if( ! function_exists('dropdown_error_class')) {
	
	function dropdown_error_class($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->dropdownErrorClass($field);
	}
}

if( ! function_exists('upload_error_class')) {
	
	function upload_error_class($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->uploadErrorClass($field);
	}
}

if( ! function_exists('error_message')) {
	
	function error_message($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->errorMessage($field);
	}
}

if( ! function_exists('input_small_wrapper')) {
	
	function input_small_wrapper($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->inputSmallWrapper($field);
	}
}

if( ! function_exists('input_large_wrapper')) {
	
	function input_large_wrapper($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->inputLargeWrapper($field);
	}
}

if( ! function_exists('input_headline_wrapper')) {
	
	function input_headline_wrapper($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->inputHeadlineWrapper($field);
	}
}

if( ! function_exists('input_date_wrapper')) {
	
	function input_date_wrapper($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->inputDateWrapper($field);
	}
}

if( ! function_exists('input_left')) {
	
	function input_left($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->inputLeft($field);
	}
}

if( ! function_exists('input_right')) {
	
	function input_right($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->inputRight($field);
	}
}

if( ! function_exists('input_bg')) {
	
	function input_bg($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->inputBg($field);
	}
}

if( ! function_exists('input_text_field')) {
	
	function input_text_field($field = '') {
		if(FALSE === ($OBJ =& _get_validation_object())) {
			return '';
		}
		
		return $OBJ->inputTextField($field);
	}
}


?>