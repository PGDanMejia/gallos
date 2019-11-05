<?php
ob_start();


//set timezone
date_default_timezone_set('America/Tegucigalpa');

$whitelist = array(
    '127.0.0.1',
    '::1',
    'localhost'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	//database credentials
	define('DBHOST','localhost');
	define('DBUSER','root');
	define('DBPASS','');
	define('DBNAME','gallos');

	//application address
	define('DIR','https://dominio.com/gallos/');
	define('SITEEMAIL','');   
}
else {
	//database credentials
	define('DBHOST','localhost');
	define('DBUSER','root');
	define('DBPASS','');
	define('DBNAME','gallos');

	//application address
	define('DIR','http://localhost/gallos/');
	define('SITEEMAIL','');
}

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("set names utf8");

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/functions.php');


$functions = new functions($db, DIR, SITEEMAIL);

?>
