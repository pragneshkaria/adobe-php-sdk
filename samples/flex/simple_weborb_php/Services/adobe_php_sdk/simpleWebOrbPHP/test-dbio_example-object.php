<?
// Run this to directly test opject methods in the "dbio_example.php"
// class before attempting AMF messaging via Flex 2.
//    There's no need to be debugging messaging problems on both
//    client and server simultaneously.
//
// I strongly recommend always stand-along testing of your WebORB for PHP
// objects methods before attempting messaging via Flex 2
//
//                            Pete Mackie
//                            Seaquest Softare

// Uncomment the "#" groups below to test method functionality, one
// group at a time.

include "dbio_example.php";

$dbio_example = new dbio_example();

$user= array('username'=>'Joseph Smith', 'emailaddress'=>'joe@adobe.yyy');
$userid = 24;

// Get User Test
# $arr = $dbio_example->getUsers();
# print_r($arr);

// Submit User Test
# $dbio_example->submitUser($user);
# $arr = $dbio_example->getUsers();
# print_r($arr);

// Delete User Test
# $arr = $dbio_example->getUsers();
# echo "---- User database before delete of \$userid $userid: "; print_r($arr);
# $dbio_example->deleteUser($userid);
# $arr = $dbio_example->getUsers();
# echo "---- User database after delete of \$userid $userid: "; print_r($arr);

// Submit User Exception Test
# try {
# 	$dbio_example->submitUserException($user);
# } catch(Exception $e) {
# 	echo "submitUserException($user) exception:\n";
# 	var_dump($e);
# 	echo "\n";
# }

// Delete User Exception Test
# try {
# 	$dbio_example->deleteUserException($userid);
# } catch(Exception $e) {
# 	echo "deleteUserException($userid) exception:\n";
# 	var_dump($e);
# 	echo "\n";
# }


?>
