<?php
class CsvWriter
{
	private $filename = "betaContentPagesLog.csv";

	public function __construct($report, $logFileName)
	{
		$this->setFileName($logFileName);
		$data  = $this->titleRow();
		$data .= $this->dataRow($report);
		file_put_contents($this->filename, $data, FILE_APPEND);
	}

	public function setFileName($writefilename)
	{
		$this->filename = $writefilename;
	}

	private function titleRow()
	{
		if (file_get_contents($this->filename, NULL, NULL, 0, 4) != "URL,")
		{
			$columnNames = "URL,Date,time,ID,FirstByte,FirstByte Repeat,StartRender,StartRender Repeat,DocumentComplete,DocumentComplete Repeat,FullyLoaded,FullyLoaded Repeat,CacheScore,CDNScore,GzipScore,CookiesScore,keepAliveScore,minifyScore,combineScore,compressScore,eTagsScore";
			return $columnNames;
		}
	}

	private function dataRow($report)
	{
		$line  = "\n" . $report->url();
		$line .= "," . $report->date();
		$line .= "," . $report->time();
		$line .= "," . $report->testId();
		$line .= "," . $report->secondsToFirstByte();
		$line .= "," . $report->secondsToFirstByte_repeat();
		$line .= "," . $report->secondsToStartRender();
		$line .= "," . $report->secondsToStartRender_repeat();
		$line .= "," . $report->secondsToDocumentComplete();
		$line .= "," . $report->secondsToDocumentComplete_repeat();
		$line .= "," . $report->secondsToFullyLoaded();
		$line .= "," . $report->secondsToFullyLoaded_repeat();
		$line .= "," . $report->cacheScore();
		$line .= "," . $report->cdnScore();
		$line .= "," . $report->gzipScore();
		$line .= "," . $report->cookiesScore();
		$line .= "," . $report->keepAliveScore();
		$line .= "," . $report->minifyScore();
		$line .= "," . $report->combineScore();
		$line .= "," . $report->compressScore();
		$line .= "," . $report->eTagsScore();
		return $line;
	}
}
?>
