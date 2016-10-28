<?php
    if(session_status() != PHP_SESSION_ACTIVE)
       session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Högquadteret</title>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link rel="stylesheet" href="style.css" type="text/css" />
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Noto+Sans|Cinzel' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="img/favicon.ico"/>
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>-->
		<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="javascript.js"></script>
        <script type="text/javascript" src="includes/functions.js"></script>
		<script src="socket.io/socket.io.js"></script>
        <script type="text/javascript" src="includes/gamepad.js"></script>
		<!--<link rel="shortcut icon" href="img/favicon.ico">-->
	</head>
    <?php require_once "includes/functions.php" ?>
    <body>
        <div class="flex">
			<div id="top">
				<div id="topcontent">
					<img src="img/whiteicon.png" style="width: 100px; height: 100px;"/>
					<a style="text-style: none; color: white;" href="index.php"><h1>Högquadteret</h1></a>
						<div id="nav">
							<ul id="navUl">
								<li pos="0" id="noll" style="border-bottom: #ff7d00 solid 4px;">Stream</li>
								<li pos="1" id="ett" >Helikoptern</li>
								<li pos="2" id="två" >Projektet</li>
								<li pos="3" id="tre" >Medverkande</li>
								<?php
									if ($_SESSION['admin']){
										echo
											"<li pos=\"4\" id=\"fyra\" >Adminverktyg</li>";
									}
								?>
							</ul>
							<div id="loginArea">
								<?php
									if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
										require 'includes/login.php';

									else
										require 'includes/loggedIn.php';
								?>
							</div>
						</div>
				</div>
			</div>
            <div id="container">
                <div id="wrapper">
                    <div class="page" id="Stream">
                        <div class="content">
                            <div class="leftContent">
                                <div style="float:left; width:550px;">
									<div id="gamepadPrompt"></div>
									<table id="gamepadDisplay">

									</table>
								</div>
                                <div id="takeControl">
                                    <div id="userControlling">

                                    </div>
									<div id="buttonArea">
										<?php
											if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == 0){
												echo "<div id=\"loginPrompt\" >Logga in för att kunna ta kontroll</div>";
											}
											else{
												echo "<div id=\"takeControlButton\" >Ta kontroll!</div>";
											}
										?>
									</div>
									<div id="ping">
									&nbsp;&nbsp;
									</div>
									<div>
										<div id="messageField">

										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page" id="Helikoptern">
                        <div class="content">
                            <div class="flexContainer">
                                <div class="contentItem">
                                    <p>
                                        Här borde det finnas bilder och en beskrivning av quadcoptern och dess specifikationer.
                                        <br/><br/>
                                        bakgrundsgrå: #262626
                                        <br/>
                                        den andra grå: #515151
                                        <br/>
                                        blå: #00b3fd
                                        <br/>
                                        orange: #ff7d00
                                    </p>
                                </div>
                                <div class="contentItem">
                                    <img src="img/pic1.JPG" style="width:100%;"/>
                                    <img src="img/pic2.bmp" style="width:100%;"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page" id="Projektet">
                        <div class="content">
                            <p>
								<br/>
								<br/>
								Här kan du läsa rapporterna till de tre gymnasiearbeten som detta projekt innefattade:
								<ul>
									<li><a href="">Högquadteret</a></li>
									<li><a href="">Styrprogram</a></li>
									<li><a href="">Hårdvara</a></li>
								</ul>

                                <br/>
                                <br/>
                            </p>
                        </div>
                        </div>
                    <div class="page" id="Medverkande">
                        <div class="content">

                        </div>
                    </div>
                    <?php
                        if ($_SESSION['admin']){
                            include "includes/AdminTools.php";
                        }
                    ?>
                </div>
            </div>
        </div>
	</body>
</html>
