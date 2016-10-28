var inControl = false;
var emit;
var ping;
var gp = navigator.getGamepads()[0];
var gpConnected = false;

function takeControl(){
	$.ajax({
		type: "GET",
		url: "includes/takeControl.php",
		data: {
			user_name : $("#popupbutton").html()
		}
	})
	.done(function(result){
		//alert(result);
		if (result == "cuc"){			//Copter Under Control
			var div = document.createElement("div");
			document.querySelector("#messageField").appendChild(div);

			var m = document.createElement("div");
			m.innerHTML = "Copter under control";
			m.style.color = "red";
			div.appendChild(m);
		}
		else {							//All Is Good
			
			socket = new io("http://217.211.253.171:20000",{'forceNew': true }); //ip till testservern som kördes hemma hos mig
			
			var div = document.createElement("div");
			document.querySelector("#messageField").appendChild(div);
			
			socket.on("connect", function () {
				inControl = true;
				$("#takeControlButton").attr("onClick", "stopControlling()");
				$("#takeControlButton").css({
					'background-color' : '#ff7d00',
					'cursor' : 'pointer'
				});
				$("#userControlling").html("Du kontrollerar just nu");
				$("#takeControlButton").html("Sluta kontrollera");
	
				if(gpConnected)
					emit = window.setInterval(emitInput, 30);
				
				pingTest();
				ping = window.setInterval(pingTest, 1000);
			});
			
			socket.on("eventmessage", function(data){
				var m = document.createElement("div");
				m.innerHTML = data.message;
				m.style.color = data.color;
				div.appendChild(m);
			});
			
			socket.on("disconnect", function () {
				inControl = false;
				
				$.ajax({
					type: "GET",
					url: "includes/stopControlling.php"		
				})
				.done(function(result){
					$("#takeControlButton").html("Ta kontroll!");
					userControlling();
					window.clearInterval(emit);
					window.clearInterval(ping);
					
					$("#ping").html("&nbsp;&nbsp;");
					
					var div = document.createElement("div");
					document.querySelector("#messageField").appendChild(div);

					var m = document.createElement("div");
					m.innerHTML = "Disconnected";
					m.style.color = "red";
					div.appendChild(m);
				});
			});
		}
	});
}
function emitInput(){
	socket.emit("input", {
		"x1":gp.axes[0], 
		"y1":gp.axes[1], 
		"x2":gp.axes[2], 
		"y2":gp.buttons[7].value - gp.buttons[6].value, 
		"arm":arm
	});
}

function stopControlling(){
	socket.disconnect();
	socket.removeAllListeners("eventsmessage");
}
function forceStopControlling(){
	inControl = false;
				
	$.ajax({
		type: "GET",
		url: "includes/stopControlling.php"		
	})
	.done(function(result){
		$("#takeControlButton").html("Ta kontroll!");
		userControlling();
		window.clearInterval(emit);
		window.clearInterval(ping);

		$("#ping").html("");

		var div = document.createElement("div");
		document.querySelector("#messageField").appendChild(div);

		var m = document.createElement("div");
		m.innerHTML = "Disconnected the controlling user by force";
		m.style.color = "red";
		div.appendChild(m);
	});
}
function userControlling(){
	if(inControl)
		return;
	$.ajax({
		type: "GET",
		url: "includes/userControlling.php"
	})
	.done(function(result){
		//console.log("Done");
		//console.log(result);
		if (result == ''){
			result = "Ingen";
			$("#takeControlButton").css({
				'background-color' : '#00b3fd',
				'cursor' : 'pointer'
			});
			$("#takeControlButton").attr("onClick", "takeControl()");
		}
		else{
			$("#takeControlButton").css({
				'background-color' : 'gray',
				'cursor' : 'not-allowed'
			});
			$("#takeControlButton").removeAttr("onClick");
		}
		
		$("#userControlling").html(result + " kontrollerar just nu");
	});
}

function pingTest(){
	var time = new Date().getTime();
	var func = function(){
		var t = new Date().getTime();
		$("#ping").html("Ping: " + (t-time) + "ms");
		socket.removeListener("ping",func);
	};

	socket.on("ping",func);
	socket.emit("ping",{});
}
$(document).ready(function() {
	var autoControlCheck = window.setInterval(userControlling, 2000);
	var hasGP = false;
	var repGP;
	
	if(canGame()) {
		var prompt = "För att din handkontroll ska anslutas, koppla in den och tryck på valfri knapp!";
		$("#gamepadPrompt").text(prompt);

		$(window).on("gamepadconnected", function() {
			gp = navigator.getGamepads()[0];
			hasGP = true;
			$("#gamepadPrompt").html("Handkontroll ansluten!");
			//console.log("connection event");
			repGP = window.setInterval(reportOnGamepad, 30);
			gpConnected = true;
			if(inControl)
				emit = window.setInterval(emitInput, 30);
		});

		$(window).on("gamepaddisconnected", function() {
			//console.log("disconnection event");
			$("#gamepadPrompt").text(prompt);
			window.clearInterval(repGP);
			window.clearInterval(emit);
			$("#gamepadDisplay").html("");
			gpConnected = false;
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

	function canGame() {
		return "getGamepads" in navigator;
	}

	function reportOnGamepad() {
		var html = "";
			html += "<tr><td>Handkontroll: </td><td>"+gp.id+"</td></tr><br/>";

		if (gp.buttons[8].pressed && gp.buttons[9].pressed)
			arm = 1;
		else
			arm = 0;

		html += "<tr><td>Vänster/höger (x1):</td><td>" + gp.axes[0] + "</td></tr><br/>";
		html += "<tr><td>Framåt/bakåt (y1):</td><td>" + gp.axes[1] + "</td></tr><br/>"; 
		html += "<tr><td>Rotation vänster/höger (x2):</td><td>" + gp.axes[2] + "</td></tr><br/>";
		html += "<tr><td>Höjd (y2):</td><td>" + (gp.buttons[7].value - gp.buttons[6].value) + "</td></tr><br/>";
		html += "<tr><td>arm :</td><td>" + arm

		$("#gamepadDisplay").html(html);
	}
});