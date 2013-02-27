<?php
//Place cron.php in a non web accessible folder, set a cron to run
include("www/speed/Tester.php");

$callbackUrl = "http://www.binaryl.com/speed/callback.php";
$DahmiansApi = "a28b1daea7444ec8ba34163237c9915c";
$dulles = "Dulles_IE8.DSL";

function testHelper($apiKeyString, $callbackUrlString, $logFileNameString, $countryString, $urlArray)
{
	$test = new Tester();
	$test->setApiKey($apiKeyString);
	$test->setCallBackUrl($callbackUrlString);
	$test->setLogFilename($logFileNameString);
	$test->setCountry($countryString);
	foreach ($urlArray as $key => $value)
	{
		$test->requestUrlToTest($value);
	}
}
$amazonUrls = array(
	"http://www.amazon.com",
	"http://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=apple&x=0&y=0",
	"http://www.amazon.com/books-used-books-textbooks/b/ref=sa_menu_bo6?ie=UTF8&node=283155"
);
testHelper($DahmiansApi, $callbackUrl, "tests/thirdParty/amazon.dulles.ie8.csv", $dulles, $amazonUrls);
