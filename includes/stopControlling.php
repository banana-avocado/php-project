<?php
	
	#update copter set controlled_by = '' where copter_ID = 1;

    include_once "db_connect.php";
        
	$stmt = $dbh->prepare("UPDATE `copter` SET `controlled_by` = '' WHERE `copter_ID` = 1");
    $stmt->execute();
?>