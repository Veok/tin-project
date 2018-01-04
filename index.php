<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'glowna';

include('include/PHPTAL.php');

switch ($page) {

    case 'glowna':
        $template = new PHPTAL("views/login.html");
        break;
    case 'login':
        include 'controllers/login.php';
        $template = new PHPTAL("views/login.html");
        break;
    case 'register':
        include 'controllers/register.php';
        $template = new PHPTAL("views/register.html");
        break;

    case 'addPicture':
        $template = new PHPTAL("views/add_picture.html");
        break;
    case 'picture_list':
        header('Location: views/picture_list.php');
        break;
    default:

        die("Taka strona nie istnieje!");

}

try {
    echo $template->execute();    // Uruchomienie szablonu
} catch (Exception $e) {
    echo $e;
}


?>
