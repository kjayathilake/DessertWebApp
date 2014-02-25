<?php

// Initialize site configuration
require_once('includes/config.inc.php');

// Initialize form values
$username = NULL;
$password = NULL;

// Check for page postback
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Get user input from form
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Execute database query
	$user = new User();
	$user->username = $username;
	$user->password = $password;
	$user->save();
		
	// Redirect to site root
	redirect_to('.');
}

// Include page view
require_once(VIEW_PATH.'login.view.php');