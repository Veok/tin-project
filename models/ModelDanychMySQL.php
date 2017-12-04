<?php

class ModelDanych{

public function __construct(){

	// Parametry dostepu do bazy danych
	define("CONF_DB_NAME","tin");
	define("CONF_DB_USER","lele");
	define("CONF_DB_PASS","lele123");

	$link = mysql_connect('127.0.0.1', CONF_DB_USER, CONF_DB_PASS);
	if (!$link) die('Nie można się połaczyć z bazą danych: ' . mysql_error());
	$db_select = mysql_select_db(CONF_DB_NAME);
	if (!$db_select) die('Błąd wyboru bazy danych: ' . mysql_error());

}


public function pobierz($page){

	switch($page){

	case 'glowna':
	case 'admin':
  
		// Odczytanie tresci z bazy danych
		$query = "SELECT tresc FROM wpis WHERE id=1 LIMIT 1";
		$queryid = mysql_query($query);
		if (!$queryid) die('Błąd odczytu z bazy danych: ' . mysql_error());
		$row = mysql_fetch_row($queryid);
		$tresc = stripslashes($row[0]);
		break;


		
		$tresc = "Wybrałeś: ".$page;       // Nazwa podstrony bedzie jej trescia
	}

	return $tresc;

}



public function zapisz($tresc){

	// Zapisanie nowej tresci
	$tresc = trim(strip_tags(addslashes($tresc)));
	$query = "UPDATE wpis SET tresc = '$tresc' WHERE id=1 LIMIT 1";
	$queryid = mysql_query($query);
	if (!$queryid) die('Błąd zapisu do bazy danych: ' . mysql_error());
	Admin::$info = 'Zapisano.';

}

public function __desctruct(){

	// Zamkniecie polaczenia
	mysql_close($link);

}


}
?>