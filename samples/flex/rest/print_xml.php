<?
print "<rows>";

$start = microtime();

for( $i = 0; $i < $_GET["rows"]; $i++ )
{
	print "<row>\n\t<col1>This is row ".$i."</col1>".
		"\n\t<col2>";
	$time = microtime() - $start;
	$time *= 1000;
	print $time."</col2>".
		"\n\t<col3>More text to add to this row.</col3></row>\n";
}

print "</rows>";
?>