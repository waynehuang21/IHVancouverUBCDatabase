<?php
    $user = 'ihvan';
    $pass = 'jpubc';

    if (isset($_POST['username']) && isset($_POST['password'])) {
        
        if (($_POST['username'] == $user) && ($_POST['password'] == $pass)) {    
            
            setcookie('username', $_POST['username'], time()+60*60*24*365);
            setcookie('password', md5($_POST['password']), time()+60*60*24*365);

            header('Location: index.php');
            
        } else {
            echo 'Username/Password Invalid';
        }
        
    } else {
        echo 'You must enter a username and password';
    }
?>