<?php

    /**
     * SabreAMF_ClassNotFoundException
     * 
     * @package SabreAMF
     * @version $Id: ClassNotFoundException.php 2159 2006-09-24 21:52:00Z evert $
     * @copyright 2006 Renaun Erickson
     * @author Renaun Erickson (http://renaun.com/blog)
     * @author Evert Pot (http://www.rooftopsolutions.nl) 
     * @licence http://www.freebsd.org/copyright/license.html  BSD License (4 Clause) 
     */

    /**
     * Detailed exception 
     */
    require_once 'SabreAMF/DetailException.php';

    /**
     * This is the receipt for ClassException and default values reflective of ColdFusion RPC faults
     *
     * @uses SabreAMF_DetailException
     */
    class Flex_BasepathNotFoundException extends Exception implements SabreAMF_DetailException {

		/**
		 *	Constructor
		 */
		public function __construct( $basepath ) {
			// Specific message to ClassException
			$this->message = "Could not locate base class path " . $basepath;
			$this->code = "Server.Processing";

			// Call parent class constructor
			parent::__construct( $this->message );
		}

        public function getDetail() {

            return "Could not locate base class path.  Make sure the folder exists on the server.";

        }

    }

?>
