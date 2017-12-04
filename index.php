<?php
// Strona glowna (Kontroler)
// Pobiera podstrone do wyswietlenia oraz doczytuje odpowiednie dane z modelu i wyswietla odpowiedni widok

// pobranie parametru z paska adresu
$page = isset($_GET['page']) ? $_GET['page'] : 'glowna';

// tworzymy obiekty Modelu najpierw doczytujac klasy
//include('models/ModelDanychMySQL.php');		// Dane w bazie MySQL
	// Dane w pliku tekstowym
//include('models/ModelDanychSQLite.php');	// Dane w bazie SQLite (dane przechowywane w pliku)


include('include/PHPTAL.php'); // doczytanie klasy szablon�w (Widok)
	
// sterowanie przeplywem danych
switch($page){

  case 'glowna':

  
		// Pobranie tresci dla srodka strony (Model)

	$template = new PHPTAL("views/widok_glowna.html"); 	// Wczytanie szablonu (Widok)
							// Przypisanie zmiennej do szablonu

    break;	

  case 'login':
	include 'controllers/login.php';     	  
	  $template = new PHPTAL("views/login.html");
    break;
  case 'register':
  include 'controllers/register.php';
  $template = new PHPTAL("views/register.html");
  break;
  default: 
  
    die("Taka strona nie istnieje!");
	
}



// Oznaczenie wybranej pozycji menu klas�.
// 
// Tworzymy tablic� asocjacyjn�, kt�ra pod kluczem $page b�dzie zawiera�a
// warto�� sta�ej KLASA_MENU_WYBRANE, a pod innymi kluczami - ci�g pusty.
// Dzi�ki temu wybrany element (np. <li>) otrzyma klas� KLASA_MENU_WYBRANE 
// i mo�na go b�dzie odpowiednio ostylowa�.
define("KLASA_MENU_WYBRANE","wybrane");
$menu = array();
$menu["glowna"] = null;
$menu["admin"] = null;
define("ILE_PODSTRON",9);
for ($i=1; $i<=ILE_PODSTRON; $i++){
    $menu["podstrona".$i] = null;    // podstrona1, podstrona2 itp.
}
$menu[$page] = KLASA_MENU_WYBRANE;

$template->menu = $menu;

try {
	echo $template->execute();	// Uruchomienie szablonu
}
catch (Exception $e){
	echo $e;
}


?>
