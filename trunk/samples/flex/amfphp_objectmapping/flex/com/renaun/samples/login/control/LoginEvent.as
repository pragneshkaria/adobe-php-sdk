/*

Copyright 2004 iteration::two Ltd

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

package com.renaun.samples.login.control
{
	import com.adobe.cairngorm.control.CairngormEvent;
	import com.renaun.samples.login.vo.LoginVO;

/**
 * The Cairngorm event broadcast when the user attempts to log in
 */
	public class LoginEvent extends CairngormEvent 
	{	
		/**
		 * The constructor, taking a LoginVO
		 */
		public function LoginEvent( loginVO : LoginVO ) 
		{
			super( LoginControl.EVENT_LOGIN );
			this.loginVO = loginVO;
		}
		
		/**
		 * The login details for the user
		 */
		public var loginVO : LoginVO;
	}
	
}