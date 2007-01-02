This example demonstrates the use of Flex 2 RemoteObject with SabreAMF.

STRUCTURE:

README.TXT 					- this file
/FlexSabreAMFProject/ 		- Folder containing all Flex MXML and AS code.
/sabreamf/ 					- Folder containing custom Flex gateway server for SabreAMF.  

HOW TO USE:

Get the latest SabreAMF package from osflash.org.  Follow the installation instructions on the osflash.org page.

Copy the FlexSabreAMFProject folder to your Flex Builder workspace area or into your typical projectenvironment.
Inside the FlexProject you'll find the flextest.sql file to create the database and default data.  

Copy the /sabreamf/ to the PHP web root.  You will need to access http://mydomain/sabreamf/gateway.php.
The /sabreamf/services/ contains all the remote service code the Flex application will communicate with.

