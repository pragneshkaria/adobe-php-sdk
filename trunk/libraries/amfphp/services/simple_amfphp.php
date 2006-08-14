<?php
Define('DATABASE_SERVER', 'localhost');
Define('DATABASE_USERNAME', 'flext');
Define('DATABASE_PASSWORD', 'p@ssword');
Define('DATABASE_NAME', 'flextest');

// Create new service for AMFPHP Remoting as Class
class sample {
	var $mysqli;

	function sample()  {
		// Define the methodTable for this class in the constructor
		$this->methodTable = array(
		"getUsers" => array(
			"description" => "Return a list of users",
			"access" => "remote"),
		"submitUser" => array(
			"description" => "Submit a user", 
			"arguments" => array("$user"), 
			"access" => "remote")
		);

		# Connect to MySQL database....
		$this->mysqli = new mysqli(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);         
		# Check MySQL connection
		if (mysqli_connect_errno()) {
			# Dont use die (Fatal Error), return useful info to the client
			trigger_error("AMFPHP Remoting 'sample' class could not connect: " . mysqli_connect_error()); 
		}
	}

	function getUsers() {
		# Return a list of all the users
		if (!$result=@$this->mysqli->query("SELECT * from users")) {
			$errno=$this->mysqli->errno;
			$this->mysqli->close();
			trigger_error("AMFPHP Remoting 'sample' class database SELECT query error: " . $errno); 
		}
		while ($row = $result->fetch_assoc()) {
			$user_array[] = $row;
		}
		return($user_array);
	}

	function submitUser($user) {
		# Escape special characters 
		$name=$this->mysqli->real_escape_string(trim($user['username']));
		$addr=$this->mysqli->real_escape_string(trim($user['emailaddress']));
		$query = "INSERT INTO users VALUES ('', '$name', '$addr')";
		if (!@$this->mysqli->query($query)) {
			$errno=$this->mysqli->errno;
			$this->mysqli->close();
			trigger_error("AMFPHP Remoting 'sample' class database INSERT query error: " . $errno); 
		}
	}

}
?>
