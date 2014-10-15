<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Twitter
{
	private $data;
	private $consumer_key;
	private $consumer_secret;
	private $access_token;
	private $access_token_secret;
	private $connection;
	public $CI = NULL;
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();

		$this->consumer_key = $this->CI->config->item('consumer_key');
		$this->consumer_secret = $this->CI->config->item('consumer_secret');
		$this->access_token = $this->CI->config->item('access_token');
		$this->access_token_secret = $this->CI->config->item('access_token_secret');
		
		// TwitterOAuth
		include('twitteroauth/OAuth.php');
		include('twitteroauth/twitteroauth.php');
		$this->connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_token_secret);
	}	
	
	public function import_statuses($screen_name)
	{
		/*
		
		GET statuses/user_timeline
		https://dev.twitter.com/docs/api/1/get/statuses/user_timeline
		
		*/
		
		$output = $this->connection->get('statuses/user_timeline', array(
			'screen_name' => $screen_name,
			'include_entities' => false,
			'include_rts' => false,
			'exclude_replies' => true,
			'trim_user' => true,
			'count' => 20
		));
		
		// Decode results
		$tweets = $output;
		//var_dump($tweets);
		//die();
		return $tweets;
	}
	
	public function import_search($query)
	{
		/*
		
		GET search/tweets
		https://dev.twitter.com/docs/api/1.1/get/search/tweets
		
		*/
		
		$output = $this->connection->get('search/tweets', array(
			'q' => $query,
			'lang' => 'en',
			'result_type' => 'mixed',
			'include_entities' => false,
			'count' => 20
		));
		
		// Decode results
		$tweets = $output->statuses;
		return $tweets;
	}
}

?>