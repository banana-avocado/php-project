<div id="gamepadPromptAll"></div>
<div id="gamepadDisplayAll"></div>

<script>
var hasGP = false;
var repGP;
	

function canGame() {
    return "getGamepads" in navigator;
}

function reportOnGamepad() {
    var gp = navigator.getGamepads()[0];
    var html = "";
        html += "id: "+gp.id+"<br/>";

    for(var i=0;i<gp.buttons.length;i++) {
        html+= "Button "+(i+1)+": ";
        if(gp.buttons[i].pressed) html+= " pressed";
        html+= "<br/>";
    }
	html+= "Trigger 1: " + gp.buttons[6].value + "<br/>";
	html+= "Trigger 2: " + gp.buttons[7].value + "<br/>";
	html+= "Triggers combined: " + (gp.buttons[7].value - gp.buttons[6].value) + "<br/>";

    for(var i=0;i<gp.axes.length; i+=2) {
        html+= "Stick "+(Math.ceil(i/2)+1)+": "+gp.axes[i]+","+gp.axes[i+1]+"<br/>";
    }
	html += "Arm: "
	if (gp.buttons[8].pressed && gp.buttons[9].pressed)
		html += "1";
	else
		html += "0";
	
    $("#gamepadDisplayAll").html(html);	
	
	if (gp.buttons[8].pressed && gp.buttons[9].pressed)
		arm = 1;
	else
		arm = 0;
}
	
$(document).ready(function() {
	
    if(canGame()) {
        var prompt = "To begin using your gamepad, connect it and press any button!";
        $("#gamepadPromptAll").text(prompt);

        $(window).on("gamepadconnected", function() {
            hasGP = true;
            $("#gamepadPromptAll").html("Gamepad connected!");
            //console.log("connection event");
            repGP = window.setInterval(reportOnGamepad, 20);
        });

        $(window).on("gamepaddisconnected", function() {
            //console.log("disconnection event");
            $("#gamepadPromptAll").text(prompt);
            window.clearInterval(repGP);
        });

        //setup an interval for Chrome
        var checkGP = window.setInterval(function() {
            //console.log('checkGP');
            if(navigator.getGamepads()[0]) {
                if(!hasGP) $(window).trigger("gamepadconnected");
                window.clearInterval(checkGP);
            }
        }, 500);
    }

});
</script>