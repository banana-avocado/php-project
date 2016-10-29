<div class="page" id="AdminVerktyg">
	<div class="content">
        <div class="contentBox">
            <?php include "createUser.php" ?>
        </div>
        <div class="contentBox">
            <?php include "userList.php" ?>
        </div>
		<div class="contentBox">
			<div id="adminStopControlButton" onclick="forceStopControlling()">
				Stoppa kontrollant
			</div>
        </div>
        <div class="contentBox">
            <?php include "controllerTest.php" ?>
        </div>
	</div>
</div>