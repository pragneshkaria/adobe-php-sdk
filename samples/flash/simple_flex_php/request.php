<?php
/* Thanks to Pete Mackie for the code below */

Define('DATABASE_SERVER', 'localhost');
Define('DATABASE_USERNAME', 'flext');
Define('DATABASE_PASSWORD', 'p@ssword');
Define('DATABASE_NAME', 'flextest');

# Connect to the database
$mysqli = new mysqli(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

# Check connection
if (mysqli_connect_errno()) {
   printf("MySQL connect failed: %s\n", mysqli_connect_error());
   exit();
}

# Quote variable to make safe
function quote_smart($value) {
	global $mysqli;
	# Stripslashes
	if (get_magic_quotes_gpc())
		$value = stripslashes($value);

	# Quote if not integer
	if (!is_numeric($value)) 	
		$value = $mysqli->real_escape_string($value);
	return $value;
}

if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['emailaddress'] && $_POST['username']) {
		# Add the user
  	$query = sprintf("INSERT INTO users VALUES ('', '%s', '%s')", quote_smart($_POST['username']), quote_smart($_POST['emailaddress']));
		if (!@$mysqli->query($query)) {
			printf("'flextest' user database query insert error: %s\n", $mysqli->error);
			$mysqli->close();
			exit();
		}
	}
}

# Return a list of all the users
if (!$result=@$mysqli->query("SELECT * from users")) {
	printf("'flextest' user database query select error: %s\n", $mysqli->error);
	$mysqli->close();
	exit();
}

$xml_return = "<users>";
while ($user = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$xml_return .=
	"<user><userid>".$user['userid']."</userid><username>".$user['username']."</username><emailaddress>".$user['emailaddress']."</emailaddress></user>\n";
}
$xml_return.= "</users>";
$mysqli->close();
echo $xml_return;
?>
