<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$email = $_POST['email'];
$nick = $_POST['nick'];  
$hashedPassword = md5($_POST['password']);
$isEverythinkOk = true;
    require_once "connection_config.php";

mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connectionString = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if ($connectionString->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            $result = $connectionString->query("SELECT id FROM user WHERE Email='$email'");
            if (!$result) throw new Exception($connectionString->error);
            $howManyEmailsWeHave = $result->num_rows;
            if ($howManyEmailsWeHave > 0) {
                $isEverythinkOk = false;
                $_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu e-mail!";
            }
            $result = $connectionString->query("SELECT id FROM user WHERE Nick='$nick'");
            if (!$result) throw new Exception($connectionString->error);
            $howManyNickWeHave = $result->num_rows;
            if ($howManyNickWeHave > 0) {
                $isEverythinkOk = false;
                $_SESSION['e_nick'] = "Istnieje już konto o takim nicku! Wybierz inny.";
            }
            if ($isEverythinkOk == true) {
                if ($connectionString->query("INSERT INTO user (Nick, Password, Email) VALUES ('$nick', '$hashedPassword', '$email')")) {
                    $_SESSION['udanarejestracja'] = true;
                    header('Location: index.php');
                } else {
                    throw new Exception($connectionString->error);
                }
            }
            $connectionString->close();
        }
    } catch (Exception $e) {
        echo '<br />Błąd: ' . $e;
    }}
?>