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
package com.renaun.samples.login.business
{

	import com.adobe.cairngorm.business.Responder;
	import com.adobe.cairngorm.business.ServiceLocator;
	import com.renaun.samples.login.vo.LoginVO;
	
	/**
	 * @version	$Revision: 1.2 $
	 */
	public class LoginDelegate
	{
		public function LoginDelegate( responder : Responder )
		{
			this.service = ServiceLocator.getInstance().getService( "dummyDelegate" );
			this.responder = responder;
		}
	
	//------------------------------------------------------------
	
		public function login( loginVO:LoginVO ): void
		{
			var call : Object = service.checkLogin( loginVO.username, loginVO.password ); // dummy HTTP call to simulate the request
			
			call.loginVO = loginVO;
			call.resultHandler = responder.onResult;
			call.faultHandler = responder.onFault;
		}
	
	//-------------------------------------------------------------
	
		private var responder:Responder;
		private var service:Object;
	}
	
}
