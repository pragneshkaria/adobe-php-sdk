<?php
/*

Copyright 2006 Renaun Erickson (http://renaun.com)

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

@ignore
*/

include "../vo/BookVO.php";

class Login {

    function Login() {
        $this->methodTable = array(

			"checkLogin" => array(
                "description" => "Simple Login",
                "access" => "remote",
				"arguments" => array ()
            )

        );
        // Initialize db connection
    }

	function checkLogin() {
		$arr = array();
		$book = new BookVO();
		$book->name = "Adobe Flex 2: Training from the Source";
		$book->bookid = "032142316X";
		$book->publishdate = date( "F j, Y, g:i a", mktime(0, 0, 0, 8, 31, 2006) );
		$arr[] = $book;
		$book = new BookVO();
		$book->name = "ActionScript 3.0 Cookbook : Solutions and Examples for Flash Developers";
		$book->bookid = "0596526954";
		$book->publishdate = date( "F j, Y, g:i a", mktime(0, 0, 0, 9, 1, 2006) );		
		$arr[] = $book;
		$book = new BookVO();
		$book->name = "Programming Flex 2 : The Comprehensive Guide to Creating Rich Media Applications with Adobe Flex";
		$book->bookid = "059652689X";
		$book->publishdate = date( "F j, Y, g:i a", mktime(0, 0, 0, 11, 1, 2006) );
		$arr[] = $book;					

		return $arr;
	}

}
?>
