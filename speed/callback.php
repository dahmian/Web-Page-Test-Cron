<?php
include("Report.php");
include("CsvWriter.php");
$reportFilename = $_GET['filename'];
$r = new Report($_GET['id']);
$w = new CsvWriter($r, $reportFilename);
?>
Thanks!
