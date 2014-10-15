<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class RSS {

	var $CI = NULL;
	var $xml_file;
	var $base_url;

	function RSS() {
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->model('admin/admin_model');
		$this->xml_file = 'rss.xml';
		$this->base_url = base_url();
	}
	
	function generate() {
		$pub_date = date("D, d M y H:i:s O",time());
		
		$output =  '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
		$output .= '<rss version="2.0">' . "\n";
        $output .= '<channel>' . "\n";
        $output .= '<title>Sunbrella Press Room RSS</title>' . "\n";
        $output .= '<link>' . base_url() . '</link>' . "\n";
        $output .= '<description>RSS Feed for the Sunbrella Press Room</description>' . "\n";
        $output .= '<language>en-us</language>' . "\n";
        $output .= '<pubDate>' . $pub_date . '</pubDate>' . "\n";
        $output .= '<lastBuildDate>' . $pub_date . '</lastBuildDate>' . "\n";
		
		$news_array = $this->CI->admin_model->get_rss_news(10);
		if(count($news_array) > 0) {
			foreach($news_array as $item) {
				$news_content = strip_tags($item->news_content);
				$temp_pub_date = strtotime($item->news_date);
				$story_pub_date = date("D, d M y H:i:s O",$temp_pub_date);
				$output .= '<item>' . "\n";
				$output .= '<title><![CDATA[' . ascii_to_entities($item->news_headline) . ']]></title>' . "\n";
				$output .= '<link>' . $this->base_url . 'news/view/' . $item->news_id . '/' . url_title($item->news_headline,'dash',TRUE) . '</link>' . "\n";
				$output .= '<description><![CDATA[' . word_limiter(ascii_to_entities($news_content),50) . ']]></description>' . "\n";
				$output .= '<pubDate>' . $story_pub_date . '</pubDate>' . "\n";
				$output .= '</item>' . "\n";
			}
			
		}
			
		$output .= '</channel>' . "\n";
        $output .= '</rss>' . "\n";
		
		$file = $_SERVER['DOCUMENT_ROOT'] . "/" . $this->xml_file;
		$handle = fopen($file, "w+");
		$xml = fwrite($handle,$output);
		fclose($handle);
		
		if($xml) {
			return true;
		} else {
			return false;
		}
		
	}
	

}
// End of library class
// Location: system/application/libraries/rss.php
