<?php
# Updated version of "WebORB for PHP "MySQL.php" class supporting PHP 5 objects 
# and 'mysqli' (improved) database I/O. 
# -- By Pete Mackie, Seaquest Software, October 7, 2006 --

Define('DATABASE_SERVER', 'localhost');
Define('DATABASE_USERNAME', 'root');
Define('DATABASE_PASSWORD', '');

// MySQL database I/O PHP class example as a WebORB for PHP service
class MySQL {
	private $err_prefix="WebORB Remoting Error: 'MySQL' class database ";
	private $mysqli;

	public function __construct() {
		error_reporting(0);	# Silence error messages and return errors to WebORB
		# Connect to MySQL database....
		$this->mysqli = new mysqli(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD);         
		if (mysqli_connect_errno()) {
			$msg=$this->err_prefix."could not connect: ".mysqli_connect_error();
   		throw new Exception($msg);
   	}
	}

	public function getDatabases() {
		# Return an array of all the MySQL databases
		if (!$result=$this->mysqli->query("SHOW DATABASES")) {
			$msg=$this->err_prefix."SHOW DATABASES query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
		# Following is Pete's suggested return:
		while ($row = $result->fetch_array(MYSQLI_NUM)) {
		 	$db_array[] = $row[0];
		}
		# Free result set
		$result->close();
		return($db_array);
	}
	
	function getTables($databaseName) {
		# Return an array of all the tables for '$databaseName)'
		$sql = 'SHOW TABLES FROM '.$databaseName;
		if (!$result=$this->mysqli->query($sql)) {
			$msg=$this->err_prefix."SHOW TABLES query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
		while ($row = $result->fetch_array(MYSQLI_NUM)) {
			$table_array[] = $row[0];
		}
		# Free result set
		$result->close();
		return($table_array);
	}
	
	function getDataFromTable($tableName, $databaseName) {
		# Get the '$tableName' data from the '$databaseName' MySQL database
		$this->mysqli->select_db($databaseName);
		$sql = 'SELECT * FROM '.$tableName;
		if (!$result=$this->mysqli->query($sql)) {
			$msg=$this->err_prefix."SELECT * FROM query error: ".$this->mysqli->error;
			$this->mysqli->close();
   		throw new Exception($msg);
		}
		while ($row = $result->fetch_assoc()) {
				$data_array[] = $row;
		}
		# Free result set
		$result->close();
		return($data_array);
	}
}


$databaseName='businesses';
$tableName='categories';

$testObject = new MySQL();
echo "getDatabases() call returns: ";  print_r($testObject->getDatabases());
echo "\ngetTables('$databaseName') call returns: "; print_r( $testObject->getTables($databaseName));
echo "\n\ngetDataFromTable('$tableName', '$databaseName') call returns: "; print_r($testObject->getDataFromTable($tableName, $databaseName));
echo "\n";

?>