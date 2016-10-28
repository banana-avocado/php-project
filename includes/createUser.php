<form id="signupForm" method="post" action="">
    <table>
        <tr>
            <td colspan="2" style="text-align: center;">Ny användare:</td>
        </tr>
        <tr>
            <td>Användarnamn: </td>
            <td><input type="text" name="username" class="newUserInput"/></td>
        </tr>
        <tr>
            <td>Lösenord: </td>
            <td><input type="password" name="pword" class="newUserInput"/></td>
        </tr>
        <tr>
            <td>Upprepa lösenord: </td>
            <td><input type="password" name="pword2" class="newUserInput"/></td>
        </tr>
        <tr>
            <td>Giltig i antal minuter</td>
            <td><input type="number" name="dur" class="newUserInput"/></td>
        </tr>
        <tr>
            <td><input type="button" onclick="signupClick()" value="Submit"/></td>
        </tr>
    </table>
    <div id="newUserFeedback">
        Magically invisible placeholder text
    </div>
</form>
<script type="text/javascript">
    function signupClick(){
        var ajax  = new XMLHttpRequest();
        ajax.open("POST", "includes/signup.php", false);
        ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var fts = formToStringGeneral(document.getElementById("signupForm"));        
        ajax.send(fts);
		//alert(ajax.responseText);           //debug
		var resp=responseTextToData(ajax)['ajaxStatus'];
        var html = "";
		switch(resp)
		{
			case "uae": html = "That user is already registered"; break;
			case "pnm": html = "Passwords do not match"; break;
            case "msi": html = "Please fill in the entire form!"; break;
			case "aig": html = "User created successfully"; break;
			default: html = "An unknown error occured";
		}
        
        $("#newUserFeedback").html(html);
        
        $("#newUserFeedback").css("transition", "color 0s");
        $("#newUserFeedback").css("opacity", "1");
        if (resp == "aig") 
            $("#newUserFeedback").css("color", "green");
        else 
        $("#newUserFeedback").css("color", "red");
        
        setTimeout(function(){
            $("#newUserFeedback").css("transition", "color 0.5s");
            $("#newUserFeedback").css("color", "white");
        }, 500);
        
        search();
    }
    $(".newUserInput").keypress(function(event){
    //console.log(event.keyCode);           //debug
    if (event.keyCode == 13)
        signupClick();
});
</script>