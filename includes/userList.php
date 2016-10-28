Sök: <input id="search">
<table id="results">
    <tr>
        <th>Username</th>
        <th>Expiration Date</th>
        <th>Delete</th>
    </tr>
</table>


<script type="text/javascript">    
        $("#search").keyup(function(){
            search();
        });
    
    
    function deleteUser(user_name) {
		//console.log("deleteUser running");
        //alert("Are you sure you wish to delete the user?");
        $.ajax({
            type: "GET",
            url: "includes/deleteUser.php",
            data: {
                user_name : user_name
            }
        })
        .done(function(result){
            search();
            //result = JSON.parse(result);
            //console.log(result);
        });
    }
    
    $(document).ready(function(){
        search();
    });
</script>