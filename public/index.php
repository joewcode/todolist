<?php
require __DIR__ .'/../bootstrap.php';

use App\Models\User;

// only for database installation
if ( isset($_GET['install']) ) {
	require __DIR__ .'/../install.php';
	exit('successful');
}

// Auth
$authuser = false;
if ( isset($_COOKIE['authkey']) ) {
	$usr = User::where('auth_key', htmlspecialchars($_COOKIE['authkey']))->first();
	if ( $usr->id > 0 )
		$authuser = $usr;
	//unset($usr);
}

function auth() {
	return $GLOBALS['authuser'];
}

// Routing
include_once __DIR__ .'/../app/Router.php';


// .. end
