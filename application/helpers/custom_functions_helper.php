<?php

function _a($array) {
	echo "<hr><pre>";
	print_r($array);
	echo "</pre><hr>";
}

if ( ! function_exists('get_additional_scripts')) {
    function get_additional_scripts($file_ext, $additional_files) {
        switch ($file_ext) {
            case 'css':
                if (isset($additional_files) && count($additional_files) > 0) {
                    foreach ($additional_files as $key => $css_file) {
                        if (strpos($css_file, 'http') !== FALSE) {
                            echo '<link href="' . $css_file . '" rel="stylesheet" />' . "\n";
                        } else {
                            echo '<link href="' . asset_url('css/' . $css_file) . '" rel="stylesheet" />' . "\n";
                        }
                    }
                }
                break;

            case 'js':
                if (isset($additional_files) && count($additional_files) > 0) {
                    foreach ($additional_files as $key => $js_file) {
                        if (strpos($js_file, 'http') !== FALSE) {
                            echo '<script src="' . $js_file . '"></script>' . "\n";
                        } else {
                            echo '<script src="' . asset_url('js/' . $js_file) . '"></script>' . "\n";
                        }
                    }
                }
                break;
        }
    }
}

function get_copyright($start_year = '') {
	if ($start_year != '') {
		$date = $start_year . " - " . date("Y",time());
	} else {
		$date = date("Y",time());
	}
	return $date;
}

function format_date($date, $method) {
	switch($method) {

		case 'DB':
			$temp_date = explode("/",$date);
			$formatted_date = $temp_date[2] . "-" . $temp_date[0] . "-" . $temp_date[1];
			break;

		case 'DB_FULL_START':
			$temp_date = explode("/",$date);
			$formatted_date = $temp_date[2] . "-" . $temp_date[0] . "-" . $temp_date[1] . " 00:00:00";
			break;

		case 'DB_FULL_END':
			$temp_date = explode("/",$date);
			$formatted_date = $temp_date[2] . "-" . $temp_date[0] . "-" . $temp_date[1] . " 23:59:59";
			break;

		case 'Display':
			$temp_date = explode("-",$date);
			$formatted_date = $temp_date[1] . "/" . $temp_date[2] . "/" . $temp_date[0];
			break;

		case 'DisplayDotted':
			$temp_date = explode("-",$date);
			$formatted_date = $temp_date[1] . "." . $temp_date[2] . "." . $temp_date[0];
			break;

		case 'DisplayNoTime':
			$formatted_date = substr($date,5,2) . "/" . substr($date,8,2) . "/" . substr($date,0,4);
			break;

		case 'Display_MonthName':
			$temp_date = explode("-",$date);
			$formatted_date = date("F j, Y", mktime(0,0,0,$temp_date[1],$temp_date[2],$temp_date[0]));
			break;

		case 'Extract_Month':
			$temp_date = explode("-",$date);
			$formatted_date = date("F", mktime(0,0,0,$temp_date[1],$temp_date[2],$temp_date[0]));
			break;

		case 'Extract_Year':
			$temp_date = explode("-",$date);
			$formatted_date = date("Y", mktime(0,0,0,$temp_date[1],$temp_date[2],$temp_date[0]));
			break;

		case 'Extract_Day':
			$temp_date = explode("-",$date);
			$formatted_date = date("j", mktime(0,0,0,$temp_date[1],$temp_date[2],$temp_date[0]));
			break;

		case 'DisplayMonthDay':
			$temp_date = explode("-",$date);
			$formatted_date = date("F j", mktime(0,0,0,$temp_date[1],$temp_date[2],$temp_date[0]));
			break;
	}

	return $formatted_date;
}

/**************************************************************************************************
/*		Returns a timestamp in MySQL timestamp format (good for insert and modification date fields)
/**************************************************************************************************/

function current_timestamp() {
	// Note that it's not escaped, so still use DB_Clean() if you're using it in a query
	return(date('Y-m-d H:i:s', time()));
}


/********************************** Calendar Functions ******************************************************/

function get_calendar_date($date, $time = NULL, $type = 'start') {
	if ($time == NULL) {
		if ($type == 'start') {
			$formatted_date = str_replace("-","", $date);
		} else {
			$date_array = explode("-",$date);
			$formatted_date = date("Ymd",mktime(0,0,0,$date_array[1],intval($date_array[2] + 1),$date_array[0]));
		}
	} else {
		$date_string = strtotime($date . ' ' . $time);
		//Add 4 hours for Z timezone
		$adjusted_datetime = intval($date_string) + 14400;

		$temp_date_array = date("Y|m|d|H|i",$adjusted_datetime);
		$date_array = explode("|",$temp_date_array);

		$formatted_date = $date_array[0] . $date_array[1] . $date_array[2] . 'T' . $date_array[3] . $date_array[4] . '00Z';
	}

	return $formatted_date;
}

/****************************** State Array ******************************************************************/
function get_data_array($type) {
	switch($type) {
		case 'state':
			$data_array = array(
				'AL' => 'Alabama',
				'AK' => 'Alaska',
				'AZ' => 'Arizona',
				'AR' => 'Arkansas',
				'CA' => 'California',
				'CO' => 'Colorado',
				'CT' => 'Connecticut',
				'DE' => 'Delaware',
				'DC' => 'District of Columbia',
				'FL' => 'Florida',
				'GA' => 'Georgia',
				'HI' => 'Hawaii',
				'ID' => 'Idaho',
				'IL' => 'Illinois',
				'IN' => 'Indiana',
				'IA' => 'Iowa',
				'KS' => 'Kansas',
				'KY' => 'Kentucky',
				'LA' => 'Louisiana',
				'ME' => 'Maine',
				'MD' => 'Maryland',
				'MA' => 'Massachusetts',
				'MI' => 'Michigan',
				'MN' => 'Minnesota',
				'MS' => 'Mississippi',
				'MO' => 'Missouri',
				'MT' => 'Montana',
				'NE' => 'Nebraska',
				'NV' => 'Nevada',
				'NH' => 'New Hampshire',
				'NJ' => 'New Jersey',
				'NM' => 'New Mexico',
				'NY' => 'New York',
				'NC' => 'North Carolina',
				'ND' => 'North Dakota',
				'OH' => 'Ohio',
				'OK' => 'Oklahoma',
				'OR' => 'Oregon',
				'PA' => 'Pennsylvania',
				'PR' => 'Puerto Rico',
				'RI' => 'Rhode Island',
				'SC' => 'South Carolina',
				'SD' => 'South Dakota',
				'TN' => 'Tennessee',
				'TX' => 'Texas',
				'UT' => 'Utah',
				'VT' => 'Vermont',
				'VA' => 'Virginia',
				'WA' => 'Washington',
				'WV' => 'West Virginia',
				'WI' => 'Wisconsin',
				'WY' => 'Wyoming'
			);
			break;

		case 'province':
			$data_array = array(
				'Alberta' => 'Alberta',
				'British Columbia' => 'British Columbia',
				'Manitoba' => 'Manitoba',
				'New Brunswick' => 'New Brunswick',
				'Newfoundland' => 'Newfoundland',
				'Nova Scotia' => 'Nova Scotia',
				'Northwest Territories' => 'Northwest Territories',
				'Nunavut' => 'Nunavut',
				'Ontario' => 'Ontario',
				'Quebec' => 'Quebec',
				'Saskatchewan' => 'Saskatchewan',
				'Yukon' => 'Yukon'

			);
			break;

		case 'dealer_country':
			$data_array = array(
				'US' => 'United States',
				'Canada' => 'Canada',
				'Costa Rica' => 'Costa Rica',
				'Guam' => 'Guam',
				'Guatemala' => 'Guatemala',
				'Mexico' => 'Mexico',
				'Panama' => 'Panama',
				'Puerto Rico' => 'Puerto Rico'
			);
			break;

		case 'country':
			$data_array = array(
				'US' => 'United States',
				'Afghanistan' => 'Afghanistan',
				'Åland Islands' => 'Åland Islands',
				'Albania' => 'Albania',
				'Algeria' => 'Algeria',
				'American Samoa' => 'American Samoa',
				'Andorra' => 'Andorra',
				'Angola' => 'Angola',
				'Anguilla' => 'Anguilla',
				'Antarctica' => 'Antarctica',
				'Antigua and Barbuda' => 'Antigua and Barbuda',
				'Argentina' => 'Argentina',
				'Armenia' => 'Armenia',
				'Aruba' => 'Aruba',
				'Australia' => 'Australia',
				'Austria' => 'Austria',
				'Azerbaijan' => 'Azerbaijan',
				'Bahamas' => 'Bahamas',
				'Bahrain' => 'Bahrain',
				'Bangladesh' => 'Bangladesh',
				'Barbados' => 'Barbados',
				'Belarus' => 'Belarus',
				'Belgium' => 'Belgium',
				'Belize' => 'Belize',
				'Benin' => 'Benin',
				'Bermuda' => 'Bermuda',
				'Bhutan' => 'Bhutan',
				'Bolivia' => 'Bolivia',
				'Bosnia and Herzegovina' => 'Bosnia and Herzegovina',
				'Botswana' => 'Botswana',
				'Bouvet Island' => 'Bouvet Island',
				'Brazil' => 'Brazil',
				'British Indian Ocean Territory' => 'British Indian Ocean Territory',
				'Brunei Darussalam' => 'Brunei Darussalam',
				'Bulgaria' => 'Bulgaria',
				'Burkina Faso' => 'Burkina Faso',
				'Burundi' => 'Burundi',
				'Cambodia' => 'Cambodia',
				'Cameroon' => 'Cameroon',
				'Canada' => 'Canada',
				'Cape Verde' => 'Cape Verde',
				'Cayman Islands' => 'Cayman Islands',
				'Central African Republic' => 'Central African Republic',
				'Chad' => 'Chad',
				'Chile' => 'Chile',
				'China' => 'China',
				'Christmas Island' => 'Christmas Island',
				'Cocos (Keeling) Islands' => 'Cocos (Keeling) Islands',
				'Colombia' => 'Colombia',
				'Comoros' => 'Comoros',
				'Congo' => 'Congo',
				'Congo, The Democratic Republic of The' => 'Congo, The Democratic Republic of The',
				'Cook Islands' => 'Cook Islands',
				'Costa Rica' => 'Costa Rica',
				'Cote D\'ivoire' => 'Cote D\'ivoire',
				'Croatia' => 'Croatia',
				'Cuba' => 'Cuba',
				'Cyprus' => 'Cyprus',
				'Czech Republic' => 'Czech Republic',
				'Denmark' => 'Denmark',
				'Djibouti' => 'Djibouti',
				'Dominica' => 'Dominica',
				'Dominican Republic' => 'Dominican Republic',
				'Ecuador' => 'Ecuador',
				'Egypt' => 'Egypt',
				'El Salvador' => 'El Salvador',
				'Equatorial Guinea' => 'Equatorial Guinea',
				'Eritrea' => 'Eritrea',
				'Estonia' => 'Estonia',
				'Ethiopia' => 'Ethiopia',
				'Falkland Islands (Malvinas)' => 'Falkland Islands (Malvinas)',
				'Faroe Islands' => 'Faroe Islands',
				'Fiji' => 'Fiji',
				'Finland' => 'Finland',
				'France' => 'France',
				'French Guiana' => 'French Guiana',
				'French Polynesia' => 'French Polynesia',
				'French Southern Territories' => 'French Southern Territories',
				'Gabon' => 'Gabon',
				'Gambia' => 'Gambia',
				'Georgia' => 'Georgia',
				'Germany' => 'Germany',
				'Ghana' => 'Ghana',
				'Gibraltar' => 'Gibraltar',
				'Greece' => 'Greece',
				'Greenland' => 'Greenland',
				'Grenada' => 'Grenada',
				'Guadeloupe' => 'Guadeloupe',
				'Guam' => 'Guam',
				'Guatemala' => 'Guatemala',
				'Guernsey' => 'Guernsey',
				'Guinea' => 'Guinea',
				'Guinea-bissau' => 'Guinea-bissau',
				'Guyana' => 'Guyana',
				'Haiti' => 'Haiti',
				'Heard Island and Mcdonald Islands' => 'Heard Island and Mcdonald Islands',
				'Holy See (Vatican City State)' => 'Holy See (Vatican City State)',
				'Honduras' => 'Honduras',
				'Hong Kong' => 'Hong Kong',
				'Hungary' => 'Hungary',
				'Iceland' => 'Iceland',
				'India' => 'India',
				'Indonesia' => 'Indonesia',
				'Iran, Islamic Republic of' => 'Iran, Islamic Republic of',
				'Iraq' => 'Iraq',
				'Ireland' => 'Ireland',
				'Isle of Man' => 'Isle of Man',
				'Israel' => 'Israel',
				'Italy' => 'Italy',
				'Jamaica' => 'Jamaica',
				'Japan' => 'Japan',
				'Jersey' => 'Jersey',
				'Jordan' => 'Jordan',
				'Kazakhstan' => 'Kazakhstan',
				'Kenya' => 'Kenya',
				'Kiribati' => 'Kiribati',
				'Korea, Democratic People\'s Republic of' => 'Korea, Democratic People\'s Republic of',
				'Korea, Republic of' => 'Korea, Republic of',
				'Kuwait' => 'Kuwait',
				'Kyrgyzstan' => 'Kyrgyzstan',
				'Lao People\'s Democratic Republic' => 'Lao People\'s Democratic Republic',
				'Latvia' => 'Latvia',
				'Lebanon' => 'Lebanon',
				'Lesotho' => 'Lesotho',
				'Liberia' => 'Liberia',
				'Libyan Arab Jamahiriya' => 'Libyan Arab Jamahiriya',
				'Liechtenstein' => 'Liechtenstein',
				'Lithuania' => 'Lithuania',
				'Luxembourg' => 'Luxembourg',
				'Macao' => 'Macao',
				'Macedonia, The Former Yugoslav Republic of' => 'Macedonia, The Former Yugoslav Republic of',
				'Madagascar' => 'Madagascar',
				'Malawi' => 'Malawi',
				'Malaysia' => 'Malaysia',
				'Maldives' => 'Maldives',
				'Mali' => 'Mali',
				'Malta' => 'Malta',
				'Marshall Islands' => 'Marshall Islands',
				'Martinique' => 'Martinique',
				'Mauritania' => 'Mauritania',
				'Mauritius' => 'Mauritius',
				'Mayotte' => 'Mayotte',
				'Mexico' => 'Mexico',
				'Micronesia, Federated States of' => 'Micronesia, Federated States of',
				'Moldova, Republic of' => 'Moldova, Republic of',
				'Monaco' => 'Monaco',
				'Mongolia' => 'Mongolia',
				'Montenegro' => 'Montenegro',
				'Montserrat' => 'Montserrat',
				'Morocco' => 'Morocco',
				'Mozambique' => 'Mozambique',
				'Myanmar' => 'Myanmar',
				'Namibia' => 'Namibia',
				'Nauru' => 'Nauru',
				'Nepal' => 'Nepal',
				'Netherlands' => 'Netherlands',
				'Netherlands Antilles' => 'Netherlands Antilles',
				'New Caledonia' => 'New Caledonia',
				'New Zealand' => 'New Zealand',
				'Nicaragua' => 'Nicaragua',
				'Niger' => 'Niger',
				'Nigeria' => 'Nigeria',
				'Niue' => 'Niue',
				'Norfolk Island' => 'Norfolk Island',
				'Northern Mariana Islands' => 'Northern Mariana Islands',
				'Norway' => 'Norway',
				'Oman' => 'Oman',
				'Pakistan' => 'Pakistan',
				'Palau' => 'Palau',
				'Palestinian Territory, Occupied' => 'Palestinian Territory, Occupied',
				'Panama' => 'Panama',
				'Papua New Guinea' => 'Papua New Guinea',
				'Paraguay' => 'Paraguay',
				'Peru' => 'Peru',
				'Philippines' => 'Philippines',
				'Pitcairn' => 'Pitcairn',
				'Poland' => 'Poland',
				'Portugal' => 'Portugal',
				'Puerto Rico' => 'Puerto Rico',
				'Qatar' => 'Qatar',
				'Reunion' => 'Reunion',
				'Romania' => 'Romania',
				'Russian Federation' => 'Russian Federation',
				'Rwanda' => 'Rwanda',
				'Saint Helena' => 'Saint Helena',
				'Saint Kitts and Nevis' => 'Saint Kitts and Nevis',
				'Saint Lucia' => 'Saint Lucia',
				'Saint Pierre and Miquelon' => 'Saint Pierre and Miquelon',
				'Saint Vincent and The Grenadines' => 'Saint Vincent and The Grenadines',
				'Samoa' => 'Samoa',
				'San Marino' => 'San Marino',
				'Sao Tome and Principe' => 'Sao Tome and Principe',
				'Saudi Arabia' => 'Saudi Arabia',
				'Senegal' => 'Senegal',
				'Serbia' => 'Serbia',
				'Seychelles' => 'Seychelles',
				'Sierra Leone' => 'Sierra Leone',
				'Singapore' => 'Singapore',
				'Slovakia' => 'Slovakia',
				'Slovenia' => 'Slovenia',
				'Solomon Islands' => 'Solomon Islands',
				'Somalia' => 'Somalia',
				'South Africa' => 'South Africa',
				'South Georgia and The South Sandwich Islands' => 'South Georgia and The South Sandwich Islands',
				'Spain' => 'Spain',
				'Sri Lanka' => 'Sri Lanka',
				'Sudan' => 'Sudan',
				'Suriname' => 'Suriname',
				'Svalbard and Jan Mayen' => 'Svalbard and Jan Mayen',
				'Swaziland' => 'Swaziland',
				'Sweden' => 'Sweden',
				'Switzerland' => 'Switzerland',
				'Syrian Arab Republic' => 'Syrian Arab Republic',
				'Taiwan, Province of China' => 'Taiwan, Province of China',
				'Tajikistan' => 'Tajikistan',
				'Tanzania, United Republic of' => 'Tanzania, United Republic of',
				'Thailand' => 'Thailand',
				'Timor-leste' => 'Timor-leste',
				'Togo' => 'Togo',
				'Tokelau' => 'Tokelau',
				'Tonga' => 'Tonga',
				'Trinidad and Tobago' => 'Trinidad and Tobago',
				'Tunisia' => 'Tunisia',
				'Turkey' => 'Turkey',
				'Turkmenistan' => 'Turkmenistan',
				'Turks and Caicos Islands' => 'Turks and Caicos Islands',
				'Tuvalu' => 'Tuvalu',
				'Uganda' => 'Uganda',
				'Ukraine' => 'Ukraine',
				'United Arab Emirates' => 'United Arab Emirates',
				'United Kingdom' => 'United Kingdom',
				'United States Minor Outlying Islands' => 'United States Minor Outlying Islands',
				'Uruguay' => 'Uruguay',
				'Uzbekistan' => 'Uzbekistan',
				'Vanuatu' => 'Vanuatu',
				'Venezuela' => 'Venezuela',
				'Viet Nam' => 'Viet Nam',
				'Virgin Islands, British' => 'Virgin Islands, British',
				'Virgin Islands, U.S.' => 'Virgin Islands, U.S.',
				'Wallis and Futuna' => 'Wallis and Futuna',
				'Western Sahara' => 'Western Sahara',
				'Yemen' => 'Yemen',
				'Zambia' => 'Zambia',
				'Zimbabwe' => 'Zimbabwe',
			);
			break;

		case 'continent':
			$data_array = array(
				'North America' => 'North America',
				'South America' => 'South America',
				'Australia' => 'Australia',
			);
			break;

		case 'salutation':
			$data_array = array(
				'Mr.' => 'Mr.',
				'Mrs.' => 'Mrs.',
				'Miss' => 'Miss',
				'Ms.' => 'Ms.',
				'Dr.' => 'Dr.'
			);
			break;

		case 'suffix':
			$data_array = array(
				'Sr.' => 'Sr.',
				'Jr.' => 'Jr.',
				'Esq.' => 'Esq.',
			);
			break;
	}

	return $data_array;
}

function Email_Send($recipient, $from, $subject, $message) {

	if (defined('ENVIRONMENT') && ENVIRONMENT == 'development') {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/application/libraries/Mandrill.php';
		$CI = get_instance();

		$mandrill = new Mandrill($CI->config->item('mandrill_api_key'));
		$message = array (
	        'text' => $message,
	        'subject' => $subject,
	        'from_email' => $from,
	        'from_name' => $from,
	        'to' => array(
	            array(
	                'email' => $recipient
	            )
	        ),
	        'headers' => array('Reply-To' => $from)
	    );
	    $result = $mandrill->messages->send($message);
	    return TRUE;

	} else {
		$headers = 'From: ' . $from . "\r\n";
		//$headers .= 'Bcc: dev@wrayward.com' . "\r\n";
		mail($recipient, $subject, $message, $headers);
		return TRUE;
	}
}

function HTML_Email_Send($recipient, $from, $subject, $message) {
	if (defined('ENVIRONMENT') && ENVIRONMENT == 'development') {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/application/libraries/Mandrill.php';
		$CI = get_instance();

		$mandrill = new Mandrill($CI->config->item('mandrill_api_key'));
		$message = array (
			'html' => $message,
	        'text' => $message,
	        'subject' => $subject,
	        'from_email' => $from,
	        'from_name' => $from,
	        'to' => array(
	            array(
	                'email' => $recipient
	            )
	        ),
	        'headers' => array('Reply-To' => $from)
	    );
	    $result = $mandrill->messages->send($message);
	    return TRUE;

	} else {
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= 'From: ' . $from .  "\r\n";
		//$headers .= 'Bcc: dev@wrayward.com' . "\r\n";

		mail($recipient, $subject, $message, $headers);
		return(true);
	}

}

function Get_HTML_Body($html_message) {
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Untitled Document</title></head><body style="font-family:Arial, Helvetica, sans-serif; color: #FFF; font-size: 13px;">
<table width="600" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td colspan="2" style="padding: 0px 25px 0 25px;" width="550"><img src="' . base_url() . '_assets/images/hale_logo.png" width="271" height="78"/></tr><tr><td colspan="2"><table width="600" border="0" cellspacing="0" cellpadding="0" style="font-size: 13px; color:#4d4e50; line-height: 18px;"><tr><td style="padding: 0px 25px 0 25px;" width="550"><br />' . $html_message . '</td></tr><tr><br><td align="left" valign="top" style="padding: 25px; color: #666666; font-weight: bold; font-size: 11px;font:Arial, Sans-serif;"></td></tr></table></td></tr></table></body></html>';

	return $message;
}

function create_directory_tree($root) {
	$result = array();
	$current_directory  = scandir($root);

	foreach ($current_directory as $key => $value) {
		if ( ! in_array($value,array(".",".."))) {
			if (is_dir($root . DIRECTORY_SEPARATOR . $value)) {
				$result[$value] = create_directory_tree($root . DIRECTORY_SEPARATOR . $value);
			} else {
				$result[] = $value;
			}
		}
	}

    return $result;
}

function get_directory_contents($dir) {
	$result = '';
	$root = $dir;
	$current_directory  = scandir($root);
	$image_array = array();

    foreach ($current_directory as $key => $value) {
		if ( ! in_array($value,array(".",".."))) {
			$image_array[] = $value;
		}
	}

    return $image_array;
}

function get_expiration_date($days_from_now = 365) {
	$today = time();
	$expire_time = $today + (intval($days_from_now) * 86400);
	$expiration_date = date('Y-m-d',$expire_time);
	return $expiration_date;
}

if ( ! function_exists('asset_url')) {
	function asset_url($path) {
		$path = preg_replace('/(.+)\.(js|css|png|jpg|gif)/i', '$1.' . SITE_UPDATE . '.$2', $path);
		return site_url(ASSETS_DIRECTORY . $path);
	}
}

if ( ! function_exists('starts_with')) {
    function starts_with($needle, $haystack) {
        return $needle === '' || strpos($haystack, $needle) === 0;
    }
}

if ( ! function_exists('ends_with')) {
    function ends_with($needle, $haystack) {
        return $needle === '' || substr($haystack, -strlen($needle)) === $needle;
    }
}

if ( ! function_exists('get_livereload')) {
    function get_livereload() {
        if (ENVIRONMENT == 'development') {
            return "<script>document.write('<script src=\"http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1\"></' + 'script>')</script>";
        }
    }
}

if ( ! function_exists('embed_youtube')) {
    function embed_youtube($content) {
        $search = '#<a(.*?)(?:href="https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch?.*?v=))([\w\-]{10,12}).*<\/a>#x';
        $replace = '<iframe src="http://www.youtube.com/embed/$2" frameborder="0" allowfullscreen></iframe>';
        $content = preg_replace($search, $replace, $content);
        return $content;
    }
}

if ( ! function_exists('embed_vimeo')) {
    function embed_vimeo($content) {
        $search = '#<a(.*?)(?:href="https?://)?(?:www\.)?(?:vimeo\.com\/([0-9]+)).*<\/a>#x';
        $replace = '<iframe src="http://player.vimeo.com/video/$2" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
        $content = preg_replace($search, $replace, $content);
        return $content;
    }
}

if ( ! function_exists('convert_to_iframes')) {
    function convert_to_iframes($content) {

        preg_match_all("/\[iframe(?P<url>([^']*?))\]/", $content, $matches);
        if( isset($matches) && count($matches['url']) > 0) {
            foreach($matches[0] as $key => $iframe_src) {
                $search = array('/\[/','/\]/');
                $replace = array('<','></iframe>');
                $content = preg_replace($search, $replace, $content);
            }
        }
        return $content;
    }
}

if( ! function_exists('filter_page_content')) {
    function filter_page_content($content) {
        $content = embed_vimeo($content);
        $content = embed_youtube($content);
        $content = convert_to_iframes($content);
        return ascii_to_entities($content);
    }
}

if ( ! function_exists('twitterify')) {
    function twitterify($str) {
        $str = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\" class=\"text-link-orange\">\\2</a>", $str);
        $str = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\" class=\"text-link-orange\">\\2</a>", $str);
        $str = preg_replace("/@(\w+)/", "<a href=\"http://twitter.com/\\1\" target=\"_blank\" class=\"text-link-orange\">@\\1</a>", $str);
        $str = preg_replace("/#(\w+)/", "<a href=\"https://twitter.com/search?q=%23\\1\" class=\"hashtag text-link-orange\" target=\"_blank\">#\\1</a>", $str);
        return $str;
    }
}

if ( ! function_exists('remove_emoji')) {
	function remove_emoji($text) {

	    $clean_text = "";

	    // Match Emoticons
	    $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
	    $clean_text = preg_replace($regex_emoticons, '', $text);

	    // Match Miscellaneous Symbols and Pictographs
	    $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
	    $clean_text = preg_replace($regex_symbols, '', $clean_text);

	    // Match Transport And Map Symbols
	    $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
	    $clean_text = preg_replace($regex_transport, '', $clean_text);

	    // Match Miscellaneous Symbols
	    $regex_misc = '/[\x{2600}-\x{26FF}]/u';
	    $clean_text = preg_replace($regex_misc, '', $clean_text);

	    // Match Dingbats
	    $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
	    $clean_text = preg_replace($regex_dingbats, '', $clean_text);

	    return $clean_text;
	}
}

if ( ! function_exists('curl_get')) {
    function curl_get($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return $return;
    }
}

/* https://developer.vimeo.com/apis/oembed */
if ( ! function_exists('oembed_vimeo')) {
    function oembed_vimeo($video_id, $video_width = 640) {
        $oembed_endpoint = 'http://vimeo.com/api/oembed';
        $video_url = 'https://vimeo.com/' . $video_id;
        $json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width=' . $video_width;

        return json_decode(curl_get($json_url));
    }
}

if( ! function_exists('filter_custom_tags')) {
    function filter_custom_tags($type, $string, $replace) {
    	switch($type) {
    		case 'city':
    			return str_replace('[DEALER_CITY]',$replace,$string);
    			break;
    		case 'name':
    			return str_replace('[DEALER_NAME]',$replace,$string);
    			break;
    	}

    }
}

/*
	Do a check on form fields for standard form spam patterns
    @$_POST array
    @check_fields = array of fields to be checked for the pattern
    @$honeypot_field = it set, name of field that is honeypot field
*/
if ( ! function_exists('check_spam_count')) {
    function check_spam_count($post_array, $check_fields = array(), $honeypot_field = FALSE) {
    	//CHECK FOR SPAM
		$pattern1 = 'link=';
		$pattern2 = 'url=';
		$pattern3 = 'href=';

        $spam_count = 0;
        foreach($check_fields as $key => $value) {
        	if(stristr($post_array[$value],$pattern1)) {
        		$spam_count++;
        	}
        	if(stristr($post_array[$value],$pattern2)) {
        		$spam_count++;
        	}
        	if(stristr($post_array[$value],$pattern3)) {
        		$spam_count++;
        	}
        }
        if($honeypot_field) {
        	if($post_array[$honeypot_field] != '') {
        		$spam_count++;
        	}
        }
        return $spam_count;
    }
}