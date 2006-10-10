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
package com.renaun.samples.login.commands
{	
	import flash.utils.*;
	import mx.rpc.events.FaultEvent;
	import mx.rpc.events.ResultEvent;
	import mx.controls.Alert;
	
	
	import com.adobe.cairngorm.business.Responder;
	import com.adobe.cairngorm.commands.Command;
	import com.adobe.cairngorm.control.CairngormEvent;
	import com.renaun.samples.login.business.LoginDelegate;
	import com.renaun.samples.login.vo.LoginVO;
	import com.renaun.samples.login.model.ModelLocator;
	import com.renaun.samples.login.control.LoginEvent;
	import mx.collections.ArrayCollection;
	import mx.utils.ArrayUtil;
	
	/**
	 * @version	$Revision: 1.4 $
	 */
	public class LoginCommand implements Command, Responder
	{
	
		public function execute( event:CairngormEvent ):void
		{
			var delegate : LoginDelegate = new LoginDelegate( this );   
			var loginEvent : LoginEvent = LoginEvent( event );  
			delegate.login( loginEvent.loginVO );	      
		}
	
		//-------------------------------------------------------------------------
	
		public function onResult( event:* = null ):void
		{
			if( event.result ) {
				var model : ModelLocator = ModelLocator.getInstance();
				model.workflowState = ModelLocator.VIEWING_LOGGED_IN_SCREEN;
	
				var loginDate : Date = new Date();
				ModelLocator.getInstance().loginDate = loginDate;
				ModelLocator.getInstance().loginVO = LoginVO( event.token.loginVO );
				ModelLocator.getInstance().books = new ArrayCollection( ArrayUtil.toArray( event.result ) );
			} else {
				Alert.show( "Login Invalid" );				
			}
		}
	
		//-------------------------------------------------------------------------
	
	   public function onFault( event:* = null ):void
	   {
	      ModelLocator.getInstance().statusMessage = "Your username or password was wrong, please try again.";
	   }
	}
	
}
