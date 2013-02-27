<?php
class Report
{
	private $xmlResult;
	private $id;

	public function __construct($id)

	{
		$this->id = $id;
		$this->xmlResult = $this->fetchXmlResults($id);
	}

	private function xmlUrl($id)
	{
		$baseUrl = "http://www.webpagetest.org/xmlResult/";
		return $baseUrl . $id . "/";
	}

	private function fetchXmlResults($id)
	{
		$xmlFile = file_get_contents($this->xmlUrl($id));
		$xmlObj = new SimpleXMLElement($xmlFile);
		return $xmlObj;
	}

	private function convertMillisecondsToSeconds($milliseconds)
	{
		return $milliseconds / 1000;
	}

	private function getFirstResults($name)
	{
		return $this->xmlResult->data->run[0]->firstView->results->{$name};
	}

	private function getRepeatResults($name)
	{
		return $this->xmlResult->data->run[0]->repeatView->results->{$name};
	}

	public function testId()
	{
		return $this->id;
	}

	public function secondsToFirstByte()
	{
		$milliseconds = $this->getFirstResults('TTFB');
		return $this->convertMillisecondsToSeconds($milliseconds);
	}

	public function secondsToFirstByte_repeat()
	{
		$milliseconds = $this->getRepeatResults('TTFB');
		return $this->convertMillisecondsToSeconds($milliseconds);
	}

	public function secondsToStartRender()
	{
		$milliseconds = $this->getFirstResults('render');
		return $this->convertMillisecondsToSeconds($milliseconds);
	}

	public function secondsToStartRender_repeat()
	{
		$milliseconds = $this->getRepeatResults('render');
		return $this->convertMillisecondsToSeconds($milliseconds);
	}

	public function secondsToDocumentComplete()
	{
		$milliseconds = $this->getFirstResults('docTime');
		return $this->convertMillisecondsToSeconds($milliseconds);
	}

	public function secondsToDocumentComplete_repeat()
	{
		$milliseconds = $this->getRepeatResults('docTime');
		return $this->convertMillisecondsToSeconds($milliseconds);
	}

	public function secondsToFullyLoaded()
	{
		$milliseconds = $this->getFirstResults('fullyLoaded');
		return $this->convertMillisecondsToSeconds($milliseconds);
	}

	public function secondsToFullyLoaded_repeat()
	{
		$milliseconds = $this->getRepeatResults('fullyLoaded');
		return $this->convertMillisecondsToSeconds($milliseconds);
	}

	public function timeDateStamp()
	{
		$unixTimeStamp = $this->getFirstResults('date');
		$readableTimeStamp = date("Y/m/d H:i:s", "$unixTimeStamp");
		return $readableTimeStamp;
	}

	public function date()
	{
		$unixTimeStamp = $this->getFirstResults('date');
		$readableTimeStamp = date("Y/m/d", "$unixTimeStamp");
		return $readableTimeStamp;
	}

	public function time()
	{ 
		$unixTimeStamp = $this->getFirstResults('date');
		$readableTimeStamp = date("H:i:s", "$unixTimeStamp");
		return $readableTimeStamp;
	}

	public function url()
	{
		return $this->getFirstResults('URL');
	}

	public function cacheScore()
	{
		return $this->getFirstResults('score_cache');
	}

	public function cdnScore()
	{
		return $this->getFirstResults('score_cdn');
	}

	public function gzipScore()
	{
		return $this->getFirstResults('score_gzip');
	}

	public function cookiesScore()
	{
		return $this->getFirstResults('score_cookies');
	}

	public function keepAliveScore()
	{
		return $this->getFirstResults('score_keep-alive');
	}

	public function minifyScore()
	{
		return $this->getFirstResults('score_minify');
	}

	public function combineScore()
	{
		return $this->getFirstResults('score_combine');
	}

	public function compressScore()
	{
		return $this->getFirstResults('score_compress');
	}

	public function eTagsScore()
	{
		return $this->getFirstResults('score_etags');
	}
}
?>
