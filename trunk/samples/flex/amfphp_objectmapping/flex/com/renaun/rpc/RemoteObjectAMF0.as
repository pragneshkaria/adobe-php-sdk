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
package com.renaun.rpc {
	
	import flash.utils.flash_proxy;
	import flash.utils.Proxy;
	import flash.errors.IllegalOperationError;
	import flash.net.*;
	import flash.events.*;
	import mx.collections.*;
	import mx.controls.Alert;
	import mx.core.IMXMLObject;
	import mx.rpc.events.FaultEvent;	
	import mx.rpc.events.ResultEvent;
	import mx.rpc.Fault;
	import mx.rpc.mxml.IMXMLSupport;
	import com.renaun.rpc.RemotingConnection;
	import com.renaun.rpc.ResponderAMF0;
	import mx.rpc.AbstractService;
	import mx.managers.CursorManager;

	use namespace flash_proxy;

	/**
	 *  The RemoteObjectAMF0 class provides a method to connect to AMF0 gateways.
	 */
	[Event(name="fault", type="mx.rpc.events.FaultEvent")]	
	[Event(name="result", type="mx.rpc.events.ResultEvent")]
	[Bindable]
	dynamic public class RemoteObjectAMF0 extends AbstractService implements IMXMLObject, IMXMLSupport {

		public var endpoint:String;	
		public var source:String;
		public var gateway_conn : RemotingConnection;
		private var _view:Object;
		private var _id:String;
		protected var _concurrency:String;
		protected var _showBusyCursor:Boolean;	

		public var _methodResultArray:Array;
		public var _methodResponderArray:Array;		

		public var results:*;

		public function RemoteObjectAMF0() {
			_methodResultArray = new Array();
			_methodResponderArray = new Array();
		}

		flash_proxy override function callProperty( methodName:*, ...args):* {
			if( gateway_conn == null )
            	gateway_conn = new RemotingConnection( endpoint );

            var respond:ResponderAMF0 = new ResponderAMF0( methodName, setQueryResult, setQueryFault );
			
			var parameters:Array = args;
			// Help from code found here - http://www.code4net.com/archives/000119.html
			if(args.length > 0){
				parameters.unshift(source + "." + methodName.toString(),respond);
        		gateway_conn.call.apply(gateway_conn,parameters);
			} else {
                gateway_conn.call(source + "." + methodName.toString(), respond);
			}
			
			// set Busy Cursor
			if( _showBusyCursor )
				CursorManager.setBusyCursor();

	        _methodResponderArray[ methodName ] = respond;
	        return respond.getAsyncToken();
		}
		
		flash_proxy override function getProperty( name:* ):* {
			if( _methodResultArray[ name ] != null )
				return _methodResultArray[ name ];
		}		
		
		flash_proxy override function setProperty(name:*, value:*):void {
			if( name == "destination" )
				endpoint = value;
			else
				_methodResultArray[ name ] = value;
		}

		flash_proxy override function getDescendants( name:* ):* {
		
		}
		
		public function initialized( view:Object, id:String  ):void {
			_view = view;
			_id = id;
		}

        private function setQueryResult( methodName:String, result:Object ):void {
			results = result;
			
			var respond:ResponderAMF0 = _methodResponderArray[ methodName ];
			dispatchEvent( new ResultEvent( ResultEvent.RESULT, 
											false, 
											true, 
											results, 
											respond.getAsyncToken(), 
											respond.getAsyncToken().message ) );
			// remove Busy Cursor
			if( _showBusyCursor )
				CursorManager.removeBusyCursor();
											
        }

        private function setQueryFault( methodName:String, fault:Object ):void {
            var respond:ResponderAMF0 = _methodResponderArray[ methodName ];
            var code:String = "unknown fault";
            if( fault.code != null )
            	code = String( fault.code );
            var faultString:String = "";
            if( fault.level != null )
            	faultString = String( "level: " + fault.level );
            var description:String = "";
            if( fault.description != null )
            	description = String( fault.description );            	            
            	
            dispatchEvent( new FaultEvent( FaultEvent.FAULT, 
            								false, 
            								false, 
            								new Fault(code,faultString,description),
            								respond.getAsyncToken(), 
            								respond.getAsyncToken().message ) );
			// remove Busy Cursor
			if( _showBusyCursor )
				CursorManager.removeBusyCursor();
            								
        }


        /**
         *  Define public getter method.
         */
        public function get concurrency():String {
            return _concurrency;
        }
        
        /**
         *  Define public getter method.
         */
        public function set concurrency( value:String ):void {
            _concurrency = value;
        }

        /**
         *  Define public getter method.
         */
        public function get showBusyCursor():Boolean {
            return _showBusyCursor;
        }
        
        /**
         *  Define public getter method.
         */
        public function set showBusyCursor( value:Boolean ):void {
            _showBusyCursor = value;
        } 
									
	}
}

