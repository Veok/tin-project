<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'glowna';

include('include/PHPTAL.php');

// sterowanie przeplywem danych
switch ($page) {

    case 'glowna':
        $template = new PHPTAL("views/widok_glowna.html");    // Wczytanie szablonu (Widok)
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
        //include 'controllers/pictures.php';
     //   $template = new PHPTAL("views/picture_list.php");
        header('Location: views/picture_list.php');
        //  $template-> images = new pictures_list();
        break;
    default:

        die("Taka strona nie istnieje!");

}

define("KLASA_MENU_WYBRANE", "wybrane");
$menu = array();
$menu["glowna"] = null;
$menu["admin"] = null;
define("ILE_PODSTRON", 9);
for ($i = 1; $i <= ILE_PODSTRON; $i++) {
    $menu["podstrona" . $i] = null;    // podstrona1, podstrona2 itp.
}
$menu[$page] = KLASA_MENU_WYBRANE;

$template->menu = $menu;

try {
    echo $template->execute();    // Uruchomienie szablonu
} catch (Exception $e) {
    echo $e;
}


?>
