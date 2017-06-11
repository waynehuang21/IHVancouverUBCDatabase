<?php
    $user = 'ihvan';
    $pass = 'jpubc';

    if (isset($_COOKIE[['username']) && isset($_COOKIE['password')) {
        
        if (($_POST['username'] != $user) || ($_POST['password'] != md5($pass))) {    
            header('Location: login.php');
        } 
        
    } else {
        header('Location: login.php');
    }
?>