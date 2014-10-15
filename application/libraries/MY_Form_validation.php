<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Form_validation extends CI_Form_Validation {
	
	function errorClass($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input-text';
		} else {
			return 'error-input-text';
		}
	}
	
	function formInputError($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'form-input';
		} else {
			return 'form-input-error';
		}
	}
	
	function requiredText($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return '';
		} else {
			return '<span class="required">Required</span>';
		}
	}
	
	function formDropdownError($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input-dropdown';
		} else {
			return 'input-dropdown-error';
		}
	}
	
	function formTextareaError($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'textarea-text';
		} else {
			return 'error-textarea-text';
		}
	}
	
	function textareaErrorClass($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return '';
		} else {
			return 'error_textarea_border';
		}
	}
	
	function dropdownErrorClass($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input-dropdown';
		} else {
			return 'input-dropdown-error';
		}
	}
	
	function uploadErrorClass($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return '';
		} else {
			return 'error_image_upload';
		}
	}
	
	function errorMessage($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return '';
		} else {
			return $this->_field_data[$field]['error'];
		}
	}
	
	function inputSmallWrapper($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input_small';
		} else {
			return 'input_small_error';
		}
	}
	
	function inputLargeWrapper($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input_large';
		} else {
			return 'input_large_error';
		}
	}
	
	function inputHeadlineWrapper($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input_headline';
		} else {
			return 'input_headline_error';
		}
	}
	
	function inputDateWrapper($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input_date';
		} else {
			return 'input_date_error';
		}
	}
	
	function inputLeft($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input_white_left';
		} else {
			return 'input_error_left';
		}
	}
	
	function inputRight($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input_white_right';
		} else {
			return 'input_error_right';
		}
	}
	
	function inputBg($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input_white_bg';
		} else {
			return 'input_error_bg';
		}
	}
	
	function inputTextField($field = '') {
		if( !isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '') {
			return 'input_text';
		} else {
			return 'input_error';
		}
	}
	
}

?>