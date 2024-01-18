<?php
	// Start a new PHP session or resume the existing session.
	session_start();
	// Destroy the current session, effectively logging the user out and removing all session data.
	session_destroy();
	
	// Redirect the user to the "index.html" page after destroying the session.
	header("location:index.html");
?>