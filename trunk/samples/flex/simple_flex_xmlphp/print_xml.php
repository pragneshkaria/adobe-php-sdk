<?
print "<rows>";

$start = microtime();

for( $i = 0; $i < $_GET["rows"]; $i++ )
{
	print "<row><col1>This is row ".$i."</col1>".
		"<col2>";
	print microtime() - $start;
	print "</col2>".
		"<col3>More text to add to this row.</col3></row>";
}

print "</rows>";
?>