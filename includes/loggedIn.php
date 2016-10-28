<?php 
    if(session_status() != PHP_SESSION_ACTIVE)
       session_start();
?>

<div id="popupbutton">
    <?php
        echo $_SESSION['user_name'];
    ?>
</div>
<div id="popupbox">
    <div style="position: absolute; width: 100%;">
        <div style="float: left; margin-left: 0.25em; margin-top: 0.25em;">Kontrollschema</div>
        <div id="logoutbutton" onclick="signoutClick()">Logga ut</div>
    </div>
    <div id="controllericons">
        <img class="controllericon" id="c1" src="img/c1.png"/>
        <img class="controllericon" id="c2" src="img/c2.png"/>
        <img class="controllericon" id="c3" src="img/c3.png"/>
    </div>
    <div class="padding"></div>
</div>