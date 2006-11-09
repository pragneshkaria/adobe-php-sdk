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
		if (!$result=$this->mysqli->query("SELECT * from users ORDER by userid")) {
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
		$query = "INSERT INTO users VALUES (NULL, '$name', '$addr')";
		if (!$result=$this->mysqli->query($query)) {
			$msg=$this->err_prefix."INSERT query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
	}

	public function deleteUser($userid) {
		$query = "DELETE FROM users WHERE userid='$userid'";
		if (!$result=$this->mysqli->query($query)) {
			$msg=$this->err_prefix."DELETE query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
	}

	public function updateUser($userid, $username, $emailaddress) {
		$username=$this->mysqli->real_escape_string(trim($username));
		$password=$this->mysqli->real_escape_string(trim($password));
		$query = "UPDATE users SET username='$username', emailaddress='$emailaddress' WHERE userid='$userid'";
		if (!$result=$this->mysqli->query($query)) {
			$msg=$this->err_prefix."Update query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
	}

	public function login($username, $password) {
		# Check username and password with `admin` database table
		# If match in `admin` database table, then return true, otherwise return false.
		$username=$this->mysqli->real_escape_string(trim($username));
		$password=$this->mysqli->real_escape_string(trim($password));
		if (!$result=$this->mysqli->query("SELECT * from admin WHERE username='$username' AND password = sha1('$password')")) {
			$msg=$this->err_prefix."SELECT query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
		if ($result->num_rows>0)   # Valid username and password match found.
			return true;
		# Log the invalid authentications
		$date=date('Y-m-d H:i:s');  # Log the data of the invalid authentication attempt
		if (!$result=$this->mysqli->query("INSERT INTO log VALUES (NULL, '$date', '$username', '$password')")) {
			$msg=$this->err_prefix."INSERT query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
		$msg = "Invalid login for User Name: \"$username\" and Password:\"$password\". Please try again.\n";
		$this->mysqli->close();
   	throw new Exception($msg);
	}

	// --- PHP Exception examples for testing and evaluation of Flex 2 Exception Handling ---
	// --- NEVER PART OF A REAL SOLUTION ---

	public function submitUserException(array $user) {
		# Escape special characters 
		$name=$this->mysqli->real_escape_string(trim($user['username']));
		$addr=$this->mysqli->real_escape_string(trim($user['emailaddress']));
		$query = "INSERT INTO xxxusers VALUES (NULL, '$name', '$addr')";
		if (!$result=$this->mysqli->query($query)) {
			$msg=$this->err_prefix."INSERT query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
	}
	
	public function deleteUserException($userid) {
		$query = "DELETE FROM usersxxxx WHERE userid='$userid'";
		if (!$result=$this->mysqli->query($query)) {
			$msg=$this->err_prefix."DELETE query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
	}

}

?>
