<?php 

 	$conn = mysqli_connect('localhost', 'root', '', 'Tudemy');

 	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>