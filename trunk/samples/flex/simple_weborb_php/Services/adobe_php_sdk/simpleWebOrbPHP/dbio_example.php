<?php
Define('DATABASE_SERVER', 'localhost');
Define('DATABASE_USERNAME', 'flext');
Define('DATABASE_PASSWORD', 'p@ssword');
Define('DATABASE_NAME', 'flextest');

// MySQL database I/O PHP class example as a WebORB for PHP service
class dbio_example {
	private $mysqli;
	private $err_prefix="WebORB Remoting Error: 'dbio_example' class database ";

	public function __construct() {
		error_reporting(0);	# Silence error messages and return them to WebORB
		# Connect to MySQL database....
		$this->mysqli = new mysqli(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);         
		if (mysqli_connect_errno()) {
			$msg=$this->err_prefix."could not connect: ".mysqli_connect_error();
   		throw new Exception($msg);
   	}
	}

	public function getUsers() {
		# Return a list of all the 'flextest' users
		if (!$result=$this->mysqli->query("SELECT * from users")) {
			$msg=$this->err_prefix."SELECT query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
		while ($row = $result->fetch_assoc()) {
			$user_array[] = $row;
		}
		return($user_array);
	}

	public function submitUser(array $user) {
		# Escape special characters 
		$name=$this->mysqli->real_escape_string(trim($user['username']));
		$addr=$this->mysqli->real_escape_string(trim($user['emailaddress']));
		$query = "INSERT INTO users VALUES ('', '$name', '$addr')";
		if (!$result=$this->mysqli->query($query)) {
			$msg=$this->err_prefix."INSERT query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
	}
}


?>
