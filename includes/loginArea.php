<?php
	if(session_status() != PHP_SESSION_ACTIVE)
		session_start();
?>


<?php

	if(empty($_SESSION['user_id']) || $_SESSION['user_id']==0)
		require 'login.php';

	else
		require 'loggedIn.php';
?>