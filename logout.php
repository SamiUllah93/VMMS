<?php
    require_once('config.php');

    Debug::$Debug_Mode = false;
    
    $user = new User();
	$SessionLias = $user->IsLoggedIn();
    if($user->IsLoggedIn()){
        if($user->Logout()){
            header('location:index.php');
        }else{
            header('location:signin.php');
        }

    }else{
        header('location:signin.php');
    }


?>