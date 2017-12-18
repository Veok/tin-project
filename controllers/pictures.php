<?php
/**
 * Created by IntelliJ IDEA.
 * User: trebb
 * Date: 18.12.2017
 * Time: 13:09
 */

session_start();
$userId = $_SESSION['userId'];
include("connection_config.php");

$connectionString = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($connectionString->connect_errno != 0) {
    throw new Exception(mysqli_connect_errno());
} else {
    $sqlString = "SELECT * FROM picture where User_Id = '$userId'";
 //   $images =  $connectionString->query($sqlString);
    $result = mysqli_query($connectionString, $sqlString);
//    $result=mysqli_fetch_array($images);
//    foreach ($images as $img) echo '<img src="data:image/jpeg;base64,'.base64_encode( $img['Data'] ).'"/>';
//    echo '<img src="data:image/jpeg;charset=utf-8;base64    ,'.base64_encode( $result['Data'] ).'"/>';
    while($row =mysqli_fetch_array($result)){

        echo '<tr>';
        echo '<td>';
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Data'] ).'" height="100" width="100" class="img-thumnail" />';
        echo '</td>';
        echo '</tr>';
    }

//        $_SESSION['mamyZdjecia'] = true;
//        $result = mysqli_query($db, $sqlString);
//        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
//        $pictureId = $row['id'];
//        $count = mysqli_num_rows($result);
//        header('Location: ../index.php?page=picture_list');
//        echo $sqlString;
//        throw new Exception($connectionString->error);

//    $connectionString->close();
}
?>