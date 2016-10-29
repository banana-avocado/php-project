<?php
	include_once "db_connect.php";
    
	$stmt = $dbh->prepare("SELECT `controlled_by` FROM `copter` WHERE `copter_id` = 1");
	$stmt->execute();

	$res = $stmt->get_result();
	$row = $res->fetch_array();
        
	if ($row['controlled_by'] == '') {
		$stmt2 = $dbh->prepare("UPDATE `copter` SET `controlled_by` = ? WHERE `copter_ID` = 1");	
		$input = $_GET['user_name'];
		$stmt2->bind_param("s",  $input);
		$stmt2->execute();

		echo "aig";		//All Is Good
	}
	else {
		echo "cuc";		//Copter Under Control
	}

?>