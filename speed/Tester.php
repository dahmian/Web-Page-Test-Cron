<?php
class Tester
{
	private $pageTesterURL = "http://www.webpagetest.org/runtest.php";
	private $URLtoTest = "";
	private $apiKey = "";
	private $callbackURL = "";
	private $logFilename = "";
	private $country = "Dulles_IE8";

	public function __construct()
	{
	}

	public function requestUrlToTest($url)
	{
		if ($this->apiKey == "") {throw new Exception('API key must be set before requesting a URL to be tested');}
		if ($this->callbackURL == "") {throw new Exception('Callback URL must be set before requesting a URL to be tested');}
		if ($this->logFilename == "") {throw new Exception('log file name must be set before requesting a URL to be tested');}
		$this->URLtoTest = urlencode($url);
		$this->sendPOSTtoTester();
	}

	public function setApiKey($key)
	{
		//a28b1daea7444ec8ba34163237c9915c Dahmian's API key, 200 requests per day
		//9c2ffd16b27f4059b94798f4ee91337b Hal's API key, 300 requests per day
		$this->apiKey = $key;
	}

	public function setCallBackUrl($newCallbackUrl)
	{
		$this->callbackURL = urlencode($newCallbackUrl);
	}

	public function setLogFilename($filename)
	{
		$this->logFilename = urlencode($filename);
	}

	public function setCountry($country)
	{
		//List of countries can be found here: http://www.webpagetest.org/getLocations.php
		$this->country = urlencode($country);
	}

	private function sendPOSTtoTester()
	{
		$curlSession = curl_init($this->pageTesterURL);
		curl_setopt($curlSession, CURLOPT_POST, true);
		curl_setopt($curlSession, CURLOPT_POSTFIELDS, $this->generatePOSTparams());
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
		$curlResponse = curl_exec($curlSession);
		curl_close($curlSession);
	}

	private function generatePOSTparams()
	{
		$postParams  = "url=$this->URLtoTest";
		$postParams .= "&k=$this->apiKey";
		$postParams .= "&location=" . $this->country;
		$postParams .= "&f=xml";
		$postParams .= "&pingback=$this->callbackURL" . urlencode("?filename=") . $this->logFilename;
		$postParams .= "&private=1"; //does not display test on webpage test public logs
		return $postParams;
	}
}
?>
