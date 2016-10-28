<?php	
	function generateSalt($len = 32){
		$salt="";
		for(; $len>0; $len--)
			$salt .= chr(rand(33,122));
		return $salt;
	}
    function kill($msg){
        die("<div class='ajaxStatus'>$msg</div>");
    }

?>