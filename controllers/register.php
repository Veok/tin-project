<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$haslo1 = $_POST['password'];  
$email = $_POST['email'];
$nick = $_POST['nick'];  
$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
$wszystko_OK = true;
require_once "connection_config.php";

mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $polaczenie = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Czy email już istnieje?
            $rezultat = $polaczenie->query("SELECT id FROM user WHERE Email='$email'");
            if (!$rezultat) throw new Exception($polaczenie->error);
            $ile_takich_maili = $rezultat->num_rows;
            if ($ile_takich_maili > 0) {
                $wszystko_OK = false;
                $_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu e-mail!";
            }
            $rezultat = $polaczenie->query("SELECT id FROM user WHERE Nick='$nick'");
            if (!$rezultat) throw new Exception($polaczenie->error);
            $ile_takich_nickow = $rezultat->num_rows;
            if ($ile_takich_nickow > 0) {
                $wszystko_OK = false;
                $_SESSION['e_nick'] = "Istnieje już konto o takim nicku! Wybierz inny.";
            }
            if ($wszystko_OK == true) {
                //if ($polaczenie->query("INSERT INTO users VALUES (NULL, '$nick', '$haslo_hash', '$email', 1)")) {
                if ($polaczenie->query("INSERT INTO user (Nick, Password, Email) VALUES ('$nick', '$haslo_hash', '$email')")) {
                    $_SESSION['udanarejestracja'] = true;
                    header('Location: index.php');
                } else {
                    throw new Exception($polaczenie->error);
                }
            }
            $polaczenie->close();
        }
    } catch (Exception $e) {
        echo '<br />Błąd: ' . $e;
    }}
?>