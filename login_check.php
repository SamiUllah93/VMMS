<?php
    $user = new User();
	if(!$user->IsLoggedIn()){
		header('location:signin.php');
	}
?>