<?php
/**
 * Created by IntelliJ IDEA.
 * User: trebb
 * Date: 27.12.2017
 * Time: 14:14
 */
session_start();
require_once "../connection_config.php";
$connectionString = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($connectionString->connect_errno != 0) {
    throw new Exception(mysqli_connect_errno());
} else {
    $id = $_POST['id'];
    $deleteImage = "DELETE FROM picture where Id =".$id;
    if ($connectionString->query($deleteImage)) {
        $_SESSION['udaneUsuwaniePlikow'] = true;
        header('Location: ../index.php?page=picture_list');
    } else {
        echo $deleteImage;
        throw new Exception($connectionString->error);
    }
    $connectionString->close();
}