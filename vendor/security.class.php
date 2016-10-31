<?php

	/*

		Security Class
		Author ~ Liam Strong
		
		Still being worked on
 
	*/

	class security 
	{

		public $ip;
		public $blacklist;

		public function realIP()
		{
			switch(true){
			  case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
			  case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
			  case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
			  case (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) : return $_SERVER['HTTP_CF_CONNECTING_IP'];
			  default : return $_SERVER['REMOTE_ADDR'];
			}
		}
		
		public function blacklist($ip, $blacklist)
		{
			if (in_array($ip, $blacklist)) {
			    return true;
			}			
			return false;
		}


		public function proxyCheck()
		{
			if (
				  $_SERVER['HTTP_X_FORWARDED_FOR']
			   || $_SERVER['HTTP_X_FORWARDED']
			   || $_SERVER['HTTP_FORWARDED_FOR']
			   || $_SERVER['HTTP_VIA']
			   || in_array($_SERVER['REMOTE_PORT'], array(8080,801,6588,8000,3128,553,554))
			   || @fsockopen($_SERVER['REMOTE_ADDR'], 80, $errno, $errstr, 30))
			{
				return 'Detected Proxy';
			}
			return false;

		}
		
		public function grabHostname()
		{
			return gethostbyaddr($this->realIP());
		}
		
		public function grabUserAgent()
		{
			return $_SERVER['HTTP_USER_AGENT'];
		}
		
		public function pageGenerate()
		{
			$time = microtime();
			$time = explode(' ', $time);
			$time = $time[1] + $time[0];
			$finish = $time;
			$total_time = round(($finish - $start), 4);
			return $total_time;
		}
		


		public function debug()
		{
				return "<strong>IP Address: </strong> {$this->realIP()}<br/>\n" .
				"<strong>Hostname: </strong> {$this->grabHostname()}<br/>\n" .
				"<strong>User Agent: </strong> {$this->grabUserAgent()}<br/>\n" .
				"<strong>Page Generate Time: </strong> {$this->pageGenerate()}<br/>\n" .
				"<strong>Proxy Detection: {$this->proxyCheck()}</strong><br/>";
		}




	}




?>