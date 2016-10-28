<?php

    include_once "db_connect.php";
        
	$stmt = $dbh->prepare("DELETE FROM `user` WHERE `user_name` = ?");

	$input = $_GET['user_name'];
	$stmt->bind_param("s",  $input);
                      
	$stmt->execute();

    //echo "success!";
?>