<?php

// Initialize site configuration
require_once('includes/config.inc.php');

// Initialize form values
$username = NULL;
$password = NULL;

session_start();
// set time-out period (in seconds)
$inactive = 600;
 
// check to see if $_SESSION["timeout"] is set
if (isset($_SESSION["timeout"])) {
    // calculate the session's "time to live"
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
        session_destroy();
        redirect_to("login.php");
    }
}
 
$_SESSION["timeout"] = time();



// Include page view
require_once(VIEW_PATH.'home.view.php');