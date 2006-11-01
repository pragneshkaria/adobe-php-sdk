<?php

    require_once('SabreAMF/CallbackServer.php');
    require_once('SabreAMF/ClassNotFoundException.php');
    require_once('SabreAMF/UndefinedMethodException.php');
    require_once('BasepathNotFoundException.php');    
    require_once('SabreAMF/ClassMapper.php');

    /**
     * FlexServicesServer
     *
     * This class extends SabreAMF_CallbackServer to provide the features warranted with the usage of Flex 2
     * and the RemoteObject class.
     *
     * The difference between this server class and the regular server, is that this server is aware of the
     * RemoteObject destinations and source attributes.  Also the automatic assigning of Class mapping is done
     *
     * Note this does break some of the AMF0 features of SabreAMF, look for future release to support both.
     *
     * @package SabreAMF
     * @copyright 2006 Rooftop Solutions
     * @copyright 2006 Renaun Erickson
     * @author Renaun Erickson (http://renaun.com/blog)
     * @author Evert Pot (http://www.rooftopsolutions.nl)
     * @licence http://www.freebsd.org/copyright/license.html  BSD License (4 Clause)
     * @uses SabreAMF_CallbackServer
     */
    class Flex_DataServicesServer {

        private $baseClassPath;

        private $server;

        public function __construct() {

            // Set up the server
            $this->server = new SabreAMF_CallbackServer();

            // Listen to the onInvokeService event
            $this->server->onInvokeService = array($this,'invokeService');

            // Listen to the getRemoteClass event
            SabreAMF_ClassMapper::$onGetRemoteClass = array($this,'getRemoteClass');

        }

        /**
         * setBaseClassPath
         *
         * @return void
         */
        public function setBaseClassPath( $classPath = "services/" ) {
            $this->baseClassPath = $classPath;
        }

        /**
         * exec
         *
         * @return void
         */
        public function exec() {

            $this->server->exec();

        }

        public function invokeService($source,$method,$data) {

            // locate source file
            $classFile = str_replace( '.', '/', $source ) . '.php';

            try {
                // All class paths will be relative to baseClassPath
                $dirname = realpath( "./" . $this->baseClassPath );
                if( is_dir( $dirname ) ) {
                    chdir( $dirname );
                } else {
         			throw new Flex_BasepathNotFoundException( $this->baseClassPath );
       			}

                // Check to see if the source class it exists
                if( !file_exists( $classFile ) ) {
                    throw new SabreAMF_ClassNotFoundException( $source );
                }

                $includeFlag = @include_once( $classFile );

                $lastPeriod = strrpos( $source, "." );
                if( $lastPeriod > 0 )
                    $lastPeriod++;
                $className = substr( $source, $lastPeriod, strlen( $source ) - lastPeriod );

                //Check if class exists
                if( !class_exists( $className ) )
                    throw new SabreAMF_ClassNotFoundException( $source );

                $serviceInstance = new $className;
            } catch( Exception $e ) {
                throw new SabreAMF_ClassNotFoundException( $e->getMessage() );
            }

            if( !method_exists( $serviceInstance, $method ) ) {
                throw new SabreAMF_UndefinedMethodException( $source, $method );
            }

            return call_user_func_array( array( $serviceInstance, $method ), $data );

        }

		/**
		 *  Auto create the data type mapping for the respective class name.
		 * 
		 * 	@param dataClassName The data's class name to retrieve the full class name of
		 */
        public function getRemoteClass( $dataClassName ) {
            $className = $dataClassName;
            try {
                $reflectionClass = new ReflectionClass( $className );
            } catch( Exception $e ) {
                return false;
            }
            $fileName = $reflectionClass->getFileName();
            
            $basePath = $this->baseClassPath;
            if( $basePath == "" )
                $basePath = getcwd();

			// Handle OS filesystem differences
            if( DIRECTORY_SEPARATOR == "\\" && ( strpos( $basePath, DIRECTORY_SEPARATOR ) === false ) )
                $basePath = str_replace( "/", DIRECTORY_SEPARATOR, $basePath );
                
            $fullClassName = substr( $fileName, strpos( $fileName, $basePath ) );
            $fullClassName = substr( $fullClassName, strlen( $basePath ) );
            $fullClassName = substr( $fullClassName, 0, strlen( $fullClassName ) - 4 );
            $fullClassName = str_replace( DIRECTORY_SEPARATOR, '.', $fullClassName );

            return $fullClassName;
        }

   }



/*
  // Warning, untested
  require_once 'SabreAMF/CallbackServer.php';

  class ServiceMapper {

     private $server;
     private $baseClassPath;

     function __construct() {
        //Construct the server
        $this->server = new SabreAMF_CallbackServer();
        // Listen to the event
        $this->server->onInvokeService = array($this,'serviceInvoke');
     }

     function serviceInvoke($service,$method,$arguments) {

       $dirname = realpath("./" . $this->baseClassPath);
       //Does the classpath exist    
       if (is_dir($dirname)) {
          chdir($dirname);
       } else {
         throw new Exception('Could not locate base class path: ' . $this->baseClassPath);
       }

       $classpath = $dirname . str_replace('.','/',$source) . '.php';

       //Can we actually open the file?

       if (!is_readable($classpath)) {
         throw new Exception('Could not open file: ' . $classpath);
       }

       require_once $classpath;

       $classname = str_replace('.','_',$source);

       if (!class_exists($classname)) {
          throw new Exception('Class not found: ' . $classname);
       }
       $serviceInstance = new $class;

       // Invoking the method
       return call_user_func_array(array($serviceInstance,$method),$arguments);

     }

     function setBaseClassPath($classPath = 'services/') {
        $this->baseClassPath = $classPath;
     }

     function exec() {
        return $this->server->exec();
     }

  }

  $server = new ServiceMapper();
  $server->setBaseClassPath('services/');
  $server->exec();
*/
?>