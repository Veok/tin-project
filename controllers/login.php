<?php

session_start();
include("connection_config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $myusername =  $_POST['nick'];
    $mypassword =  $_POST['password'];
    //need fix
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $r = '$2y$10$ItXcruZqHxK0zrhJP.q7menzl.bYqv33Mk/U5iD70w0mDMC.g/r16';
    $sql = "SELECT id FROM user WHERE Nick = '$myusername' and Password ='$r' ";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];
    $count = mysqli_num_rows($result);
    // If result matched $myusername and $mypassword, table row must be 1 row
    if ($count == 1) {
        $_SESSION['login_user'] = $myusername;
        $_SESSION['logged'] = true;
        echo '<script type="text/javascript">
           window.location = "add_picture.html"
      </script>';
    } else {
        $_SESSION['logged'] = false;
        $error = "Niepoprawny Login lub Hasło. '$verify' ";
        echo '<script type="text/javascript">
        alert("Podano bledne dane!");
   </script>';
    }
}
?>