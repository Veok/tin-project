<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns:tal="http://www.w3.org/1999/xhtml">
<head>
    <title>Przyklad - wzorzec MVC + panel administracyjny</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="../style.css" type="text/css"/>
</head>


<div id="strona">

    <div id="naglowek">
        <h2><a href="index.php?page=glowna" tal:attributes="class menu/glowna">Nagłówek</a></h2>
    </div>

    <div id="kolumnaLewa">
        <div id="menuPionowe">
            <ul class="ukladPionowy">
                <li><a href="index.php?page=podstrona3" tal:attributes="class menu/podstrona3">Podstrona 3</a></li>
                <li><a href="index.php?page=podstrona4" tal:attributes="class menu/podstrona4">Podstrona 4</a></li>
                <li><a href="controllers/logout.php" tal:attributes="class menu/podstrona5">Wyloguj się</a></li>
            </ul>
        </div>

    </div>

    <div id="kolumnaPrawa">
        <div id="tresc" tal:condition="exists: tresc" tal:content="tresc">
            <?php
            /**
             * Created by IntelliJ IDEA.
             * User: trebb
             * Date: 18.12.2017
             * Time: 13:09
             */

            session_start();
            $userId = $_SESSION['userId'];
            include("../connection_config.php");

            $connectionString = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
            if ($connectionString->connect_errno != 0) {
                throw new Exception(mysqli_connect_errno());
            } else {
                $sqlString = "SELECT * FROM picture where User_Id = '$userId'";
                $result = mysqli_query($connectionString, $sqlString);
                $row = mysqli_fetch_array($result);
                $ids = [];
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $imgData = ($row['Image_Data']);
                    $id = $row['Id'];
                    array_push($ids,$id);
                    $img = '<img src="data:image/jpeg;base64,' . base64_encode($imgData) . '" style="width:256px;height:144px;display:block"/>';
                    echo '<tr>';
                    echo '<td>';
                    echo $img . " ";
                    echo '<form method="post" action="../controllers/deletePicture.php">';
                    echo '<input type="hidden" name="id" value="'.$id.'"/>';
                    echo '<button type="submit" class="button" name="delete"  />Usuń</button>';
                    echo '</form>';
                    $i++;
                }
            }
            ?>
        </div>
    </div>

    <div id="stopka">
    </div>

</div>

</html>