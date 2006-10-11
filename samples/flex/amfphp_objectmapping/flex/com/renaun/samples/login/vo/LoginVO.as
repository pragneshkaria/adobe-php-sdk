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
package com.renaun.samples.login.vo
{

	import com.adobe.cairngorm.vo.ValueObject;
	
   	[Bindable]
	public class LoginVO implements ValueObject
	{
		public var username : String;
		public var password : String;
		public var loginDate : Date;
	}
	
}