/*

Copyright 2005 iteration::two Ltd

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

/**
 * @version	$Revision: 1.4 $
 */
package com.renaun.samples.login.model
{
 	import com.adobe.cairngorm.model.ModelLocator;
 	import com.renaun.samples.login.vo.LoginVO;
 	import mx.collections.ArrayCollection;
 	
 	[Bindable]
	public class ModelLocator implements com.adobe.cairngorm.model.ModelLocator
	{		
		private static var modelLocator:com.renaun.samples.login.model.ModelLocator;
		
		public static function getInstance():com.renaun.samples.login.model.ModelLocator 
		{
			if ( modelLocator == null )
				modelLocator = new com.renaun.samples.login.model.ModelLocator();
				
			return modelLocator;
	   }
	   
		//-------------------------------------------------------------------------
		   
	   	// Constructor should be private but current AS3.0 does not allow it yet (?)...
	   	public function ModelLocator() 
	   	{	
	   		if ( com.renaun.samples.login.model.ModelLocator.modelLocator != null )
				throw new Error( "Only one ModelLocator instance should be instantiated" );	
	   	}

		[ArrayElementType("com.renaun.samples.vo.BookVO")]
		public var books:ArrayCollection;
   	
		//-------------------------------------------------------------------------
			
		public var statusMessage : String;
		public var loginDate : Date;
		public var loginVO : LoginVO;
		public var workflowState : Number;

		public static const VIEWING_LOGIN_SCREEN : Number = 1;
		public static const VIEWING_LOGGED_IN_SCREEN : Number = 2;
	}
	
}

