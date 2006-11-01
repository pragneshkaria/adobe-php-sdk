<?php
/*
Modifications done by Renaun Erickson (http://renaun.com) 2006

Copyright (c) 2006. Adobe Systems Incorporated.
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

  * Redistributions of source code must retain the above copyright notice,
    this list of conditions and the following disclaimer.
  * Redistributions in binary form must reproduce the above copyright notice,
    this list of conditions and the following disclaimer in the documentation
    and/or other materials provided with the distribution.
  * Neither the name of Adobe Systems Incorporated nor the names of its
    contributors may be used to endorse or promote products derived from this
    software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
POSSIBILITY OF SUCH DAMAGE.

@ignore
*/

/**
 * Data Transfer Object / Value Object for Product
 * 
 * represents a Product on sale in the store
 * 
 * @version $Revision: 1.2 $
 */
class ProductVO {

	// AMFPHP specific object mapping implementation
	var $_explicitType = "com.adobe.cairngorm.samples.store.vo.ProductVO";
	var $id;
	var $name;
	var $description;
	var $price;
	var $image;
	var $thumbnail;


	function setId( $value )
	{
		$this->id = $value;
	}

	function setName( $value )
	{
		$this->name = $value;
	}

	function setDescription( $value )
	{
		$this->description = $value;
	}
		
	function setPrice( $value )
	{
		$this->price = $value;
	}
			
	function setImage( $value )
	{
		$this->image = $value;
	}
			
	function setThumbnail( $value )
	{
		$this->thumbnail = $value;
	}

	function getDescriptionLength()
	{
		return ( !isset( $description ) ) ? 0 : strlen( $description );
	}
	
	function toString()
	{
		return "id: $id, name: $name, description: $description, price: $price, image: $image, thumbnail: $thumbnail";
	}

}
?>