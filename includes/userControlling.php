<?php
	
    include_once "db_connect.php";
    
	$stmt = $dbh->prepare("SELECT `controlled_by` FROM `copter` WHERE `copter_id` = 1");

	$stmt->execute();

	$res = $stmt->get_result();

	$row = $res->fetch_array();

	echo $row['controlled_by'];
    //echo json_encode($row);


?>