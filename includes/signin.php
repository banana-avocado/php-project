<?php
	if(session_status() != PHP_SESSION_ACTIVE)
		session_start();
?>

<?php

	function verifyPassHash($fromDB, $writtenPass){
        /*
            pass column in table is 96 long
            32 + 64 = 96
            salt is 32 chars long
            hash is 64 chars long
        */
		$salt = substr($fromDB, 0, 32);
		$hashDB = substr($fromDB, 32);
		$pepper = file_get_contents('pepper.txt');

		$hashGen = hash("sha256", $salt . $writtenPass . $pepper);

		return $hashDB == $hashGen;
	}

?>

<?php
    require_once 'functions.php';
	$uname 		= $_POST['uname'];
	$pword	    = $_POST['pword'];

	require 'db_connect.php';

	$stmt = $dbh->prepare("SELECT * FROM `user` WHERE `user_name`=?");

	if(! $stmt)
		kill("" . $dbh->errno);

	if(! ($stmt->bind_param("s", $uname)) )
		kill("fbp");			//Failed to Bind Parameters

	if(! $stmt->execute())
		kill("fes" . $dbh->errno);//Failed to Execute Statement

	$res = $stmt->get_result();

	if($res->num_rows<1)
		kill("unf");			//User Not Found

	$row = $res->fetch_array();

	if(! verifyPassHash($row['pass'], $pword))
		kill("icp");			//InCorrect Password

	$_SESSION['user_id'] = $row['user_ID'];
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['controller_cfg'] = $row['controller_cfg'];
    $_SESSION['admin'] = $row['admin'];

	echo $_SESSION['admin'];

    $_SESSION['expiration_date'] = $row['expiration_date'];

    #echo "<div class='var_controller_cfg'>" . $_SESSION['controller_cfg'] . "</div>";
	if($_SESSION['admin'])
		kill("aiga");				//All Is Good + Admin
	else
		kill("aig");
?>