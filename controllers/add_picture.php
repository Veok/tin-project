<?php
/**
 * Created by IntelliJ IDEA.
 * User: trebb
 * Date: 18.12.2017
 * Time: 11:33
 */
session_start();
extract($_POST);
$error = array();
$extension = array('jpeg', 'jpg', 'png', 'gif');
$userId = $_SESSION['userId'];
require_once "../connection_config.php";
$images = $_FILES["files"]["tmp_name"];
$count = 0;
foreach ($images as $index => $image) {
    $connectionString = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if ($connectionString->connect_errno != 0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        $extInfo = pathinfo($_FILES['files']['name'][$count], PATHINFO_EXTENSION);
        if (in_array($extInfo, $extension)) {
            $date = date('Y-m-d H:i:s');
            $image2 = addslashes(file_get_contents($_FILES['files']['tmp_name'][$count]));
            $count += 1;
            $sqlString = "INSERT INTO picture (Name,AddedDate,Image_Data,User_Id) VALUES ('name','$date','$image2','$userId')";
            if ($connectionString->query($sqlString)) {
                $_SESSION['udaneDodaniePlikow'] = true;
                header('Location: ../index.php?page=picture_list');
            } else {
                echo $sqlString;
                throw new Exception($connectionString->error);
            }
        }
        $connectionString->close();
    }
}
header('Location: ../index.php?page=picture_list');
?>