<?php

session_start();
include("connection_config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = $_POST['nick'];
    $mypassword = $_POST['password'];
    $hashedPassword = md5($mypassword);
    $sql = "SELECT id FROM user WHERE Nick = '$myusername' and Password = '$hashedPassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $userId = $row['id'];
    $count = mysqli_num_rows($result);
    // If result matched $myusername and $mypassword, table row must be 1 row
    if ($count == 1) {
        $_SESSION['login_user'] = $myusername;
        $_SESSION['logged'] = true;
        $_SESSION['userId'] = $userId;
        header('Location: index.php?page=addPicture');

    } else {
        $_SESSION['logged'] = false;
        echo '<script type="text/javascript">
        alert("Podano bledne dane!");
       </script>';

    }
}
?>