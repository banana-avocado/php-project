function responseTextToData(ajaxObj) {
    var obj = {};
    var elem = document.createElement("div");
    elem.innerHTML = ajaxObj.responseText;
    var divs = elem.getElementsByTagName("div");

    for (var i = 0; i<divs.length; i++){
        obj[divs[i].className] = divs[i].innerHTML;
    }
    return obj;
}

function formToStringGeneral(form){
    var inputs = form.getElementsByTagName("input");
    var str = "";

    for(var i=0;i<inputs.length;i++)
        if(inputs[i].type!="button" && inputs[i].type!="submit")
            str += "&" + inputs[i].name + "=" + inputs[i].value;

    return str.substring(1);
}
/*
function formToString(form){
    var inputs = form.getElementsByTagName("input");

    var str =   inputs[0].name + "=" + inputs[0].value
    + "&" +     inputs[1].name + "=" + inputs[1].value;

    return str;
}
*/

function loggedIn(admin){
	$.ajax({
		type: "GET",
		url: "includes/loggedIn.php"
	})
	.done(function(response){
		$("#loginArea").html(response);
		popupboxRight();

		$("#buttonArea").html("<div id=\"takeControlButton\" >Ta kontroll!</div>");

		userControlling();

		$(".loginfield").keypress(function(event){
			//console.log(event.keyCode);       //debug
			if (event.keyCode == 13)
				signinClick();
		});
	});

	if(admin){
		$.ajax({
			type: "GET",
			url: "includes/AdminTools.php"
		})
		.done(function(response){
			$("#wrapper").html((document.getElementById("wrapper").innerHTML) + response);
			$("#navUl").html((document.getElementById("navUl").innerHTML) + "<li pos=\"4\" id=\"fyra\" >Adminverktyg</li>");
			resize();
			navClick();
			slide();
		});

	}
}

function signinClick(){
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "includes/signin.php", false);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.send(formToStringGeneral(document.getElementById("loginForm")));
    var resp=responseTextToData(ajax)['ajaxStatus'];

	//alert(ajax.responseText);   //debug

    switch(resp)
    {
        case "unf": alert("That user is not registered"); break;
        case "icp": alert("Wrong password"); break;
        case "aiga": loggedIn(1); break;
		case "aig": loggedIn(0); break;
        default: alert("An unknown error occured");
    }
}

$(".loginfield").keypress(function(event){
    //console.log(event.keyCode);       //debug
    if (event.keyCode == 13)
        signinClick();
});

function loggedOut(){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "includes/login.php", false);
    ajax.send();
    document.getElementById("loginArea").innerHTML=ajax.responseText;
    popupboxRight();

    window.clearInterval(repGP);
	$("#fyra").remove();
	$("#AdminVerktyg").remove();

	if(inControl)
		stopControlling();

	$("#buttonArea").html("<div id=\"loginPrompt\" >Logga in för att kunna ta kontroll</div>");

	userControlling();


}

function signoutClick(){
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "includes/signout.php", false);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.send();
    //var resp=responseTextToData(ajax)['ajaxStatus'];
    loggedOut();
}
