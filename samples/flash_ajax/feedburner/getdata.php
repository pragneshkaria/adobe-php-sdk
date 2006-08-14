<?php
$fpURL = 'http://api.feedburner.com/awareness/1.0/GetFeedData?uri=adobe/mpotter&dates=2006-07-01,2006-07-17';
$handle = fopen($fpURL, "r");
while (!feof($handle)) {
	$strOutData .= fread($handle, 8192);
}
fclose($handle);
header('Content-type: text/xml');
echo $strOutData;
?>