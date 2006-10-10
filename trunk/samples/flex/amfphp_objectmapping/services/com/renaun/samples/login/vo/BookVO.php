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

class BookVO {
	public $_explicitType = "com.renaun.samples.login.vo.BookVO";
	public $name;
	public $bookid;
	public $publishdate;
	public $createddate;

	function BookVO() {
	
		$b = pack("d", time());	// pack	the	bytes
/*
		if ($this->isBigEndian)	{ // if	we are a big-endian	processor
			$r = strrev($b);
		} else { //	add	the	bytes to the output
			$r = $b;
		} 	
*/		
		$this->createddate = time() / 1000;
	}

}
?>