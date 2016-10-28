<?php

    define('DB_USER',		'peter');
    define('DB_PASSWORD',	'Quadrocopte');
    define('DB_NAME', 		'hq');
    define('DB_HOST', 		'localhost');

    $dbh = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

?>