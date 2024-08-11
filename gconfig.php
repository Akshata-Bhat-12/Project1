<?php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('gdfgsfgdfh.apps.googleusercontent.com'); // gdfgsfgdfh add google clint id 

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('GOCSPX-9OFNFf-DxFkON-x40UmrbB3g');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://localhost/jnana/home');

//
$google_client->addScope('email');

$google_client->addScope('profile');

session_start();
?>