<?php 
function Upload($file,$path="./img/"){
	if(@copy($file['tmp_name'],$path.$file['name'])){
		
		@chmod($path.$file,0777);
		}else{
			return false;
		}
	
	
	
	}



?>