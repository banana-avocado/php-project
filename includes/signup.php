<?php
    require_once "functions.php";

    $uname		= $_POST['username'];
    if  ($_POST['pword'] == $_POST['pword2'])
	   $pword	= $_POST['pword'];
    else
        kill("pnm");        //Passwords do Not Match

    if ($_POST['uname'] == '' && $_POST['pword'] == '' &&  $_POST['pword2'] == '')
        kill("msi");        //Missing Some Input

	require 'db_connect.php';

	$res = $dbh->query("SELECT COUNT(*) AS count FROM `user` WHERE `user_name`='" . $uname . "'");

	$errNum=$dbh->errno;
	if($errNum != 0)
		kill("No user " . $errNum);

	$row = $res -> fetch_array();

	if($row['count'] != 0)
		kill("uae");		//User Already Exists

	$salt 		= generateSalt(32);
	$pepper 	= file_get_contents("pepper.txt");

	$hash = hash("sha256", $salt . $pword . $pepper);

	$passToStore = $salt . $hash;
    
    //If expiration date is set
    if (isset ($_POST['dur']) && $_POST['dur'] != "" ){
        
        $ctime = new DateTime();
        $ctime->add(new DateInterval("PT".$_POST['dur']."M"));
        echo "Kontot går ut: ".$ctime->format("Y-m-d  H:i:s");
        
        $stmt = $dbh->prepare("insert into user (user_name, pass, expiration_date) values (?, ?, ?)");

        if(!$stmt)
            kill("Prepare statement failed " . $dbh->errno);

        if(! ($stmt->bind_param("sss", $uname, $passToStore, $ctime->format('Y-m-d  H:i:s'))) )
            kill("fbp");			//Failed to Bind Parameters
    }
    else{
        $stmt = $dbh->prepare("insert into user (user_name, pass) values (?, ?)");

        if(!$stmt)
            kill("Prepare statement 2 failed " . $dbh->errno);

        if(! ($stmt->bind_param("ss", $uname, $passToStore)) )
            kill("fbp");			//Failed to Bind Parameters
    }

	$stmt->execute();

	$errNum=$dbh->errno;
	if($errNum!=0)
		kill("Execute failed" . $errNum);

	kill("aig");       			//All Is Good
?>