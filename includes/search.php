<?php
    include_once "db_connect.php";
    
    $input = $_GET['search'];

    if ($input == ''){
        $stmt = $dbh->prepare("SELECT `user_name`, `expiration_date`, `admin` FROM `user`");
	
	}
    else{
        $stmt = $dbh->prepare("SELECT `user_name`, `expiration_date`, `admin` FROM `user` WHERE `user_name` LIKE ?");
        $param = $input . "%";
        $stmt->bind_param("s", $param);
    }
	$stmt->execute();

	$res = $stmt->get_result();

	$row = $res->fetch_all();

    echo json_encode($row);
?>