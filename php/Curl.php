<?php 


Class Curl
{
	private $curl;
	private $url_curl;
	private $error;
	private $port;
	private $method;

	function __construct( $url )
	{
		$this->curl 	= curl_init();
		$this->url_curl = $url;
		$this->port 	= $this->getPort();
		
		curl_setopt_array($this->curl, array(
			CURLOPT_PORT => $this->getPort(),
			CURLOPT_URL => $this->url_curl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 300,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $this->getMethod(),
		));
	}

	public function getResponse()
	{
		return curl_exec($this->curl);
	}

	public function getError()
	{
		return curl_error($this->curl);
	}

	public function setPort( $port = '8020' )
	{
		$this->port = $port;
	}
	
	public function getPort()
	{
		return $this->port;
	}

	public function setMethod( $method = 'GET' )
	{
		$this->method = $method;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function closeCurl()
	{
		curl_close($this->curl);
	}

}