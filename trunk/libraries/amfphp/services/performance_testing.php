<?php
// Create new service for PHP Remoting as Class
class sample
{
    function sample () 
	{
        // Define the methodTable for this class in the constructor
        $this->methodTable = array(
            "getData" => array(
                "description" => "Return a list of data",
                "access" => "remote"
            )
        );
    }

	function getData() {
		for( $i = 0; $i < 40000; $i++ )
		{
			$Col1 = "This is row ".$i;
			$Col2 = "10000000";
			$Col3 = "More text to add to this row.";
			$ThisRow = array("col1"=>$Col1, "col2"=>$Col2, "col3"=>$Col3 );
			$TotalArray[] = $ThisRow;
		}
		return( $TotalArray );
	}
}
?>