<?php
	if(session_status() != PHP_SESSION_ACTIVE)
		session_start();
?>

<form action="" method="post" id="loginForm">
    <div id="popupbutton" onclick="signinClick()">Login</div>
    <div id="popupbox">
        <div class="textflex">
            <div style="width: 50%">
                Användarnamn
            </div>
            <div>
                Lösenord
            </div>
        </div>
        <input type="text" name="uname" class="loginfield" >
        <input type="password" name="pword" class="loginfield">
        <div class="padding"></div>
    </div>
</form>
<script type="text/javascript" src="includes/functions.js"></script>
