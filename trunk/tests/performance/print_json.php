<?
/* Thanks to Blaine McDonnell for the updated code below */

header('Content-Type: text/plain');

echo '[';
for( $i = 0; $i < 40000; $i++ ) {
  echo (($i > 0 ) ? "," : '') . '{"col1":"This is row ' .$i  . '","col2":10000000,"col3":"More text to add to this row."}';
}
echo ']';
?>