<?
class MySQL
{
	private $err_prefix="WebORB Remoting Error: 'MySQL' class database ";
	private $server = "localhost";
	private $username = "root";
	private $password = "";
	
	function MySQL()
	{	
	}

	function connect( )
	{
		$this->Connection = mysql_pconnect( $this->server, $this->username, $this->password );
		
		if (!$this->Connection) {
			$msg=$this->err_prefix."could not connect: ".mysql_error();
   			throw new Exception($msg);
		}
	}
	
	function getDatabases( $Username, $Password, $Server ){
		if( !$this->Connection )
			$this->connect( );
		
		$db_list = mysql_list_dbs($this->Connection);

		if( !$db_list ) {
			$msg=$this->err_prefix."could not get databases: ".mysql_error();
   			throw new Exception($msg);
		} else {
			while ($row = mysql_fetch_object($db_list)) {
    			$Return[] = $row;
			}
			return $Return;
		}
	}
	
	function getTables( $DatabaseName )
	{
		if( !$this->Connection )
		 	$this->connect();
		 	
		$sql = "SHOW TABLES FROM $DatabaseName";
		$Result = mysql_query( $sql );
		if( !$Result ) {
			$msg=$this->err_prefix."could not get tables: ".mysql_error();
   			throw new Exception($msg);
		} else {
			return( $Result );
		}
	}
	
	function getDataFromTable( $TableName, $DatabaseName )
	{
		if( !$this->Connection )
		 	$this->connect();
		 	
		$db_selected = mysql_select_db($DatabaseName);
		$sql = "SELECT * FROM ". $TableName;
		$Result = mysql_query( $sql );
		
		if( !$Result ) {
			$msg=$this->err_prefix."could not get data from table: ".mysql_error();
   			throw new Exception($msg);
		} else {
			return( $Result );
		}
	}
}
/*
$TestObject = new MySQL();
print_r( $TestObject->getDatabases() );
print_r( $TestObject->getTables( "drupal47"));
print_r( $TestObject->getDataFromTable( "users", "drupal47"));
*/
?>