<?php

class ModelDanych{

public $filename = 'models/data/ttsi_db.sqlite3';
public $db;

public function __construct(){

    if ($db = new SQLite3($this->filename)) {
        $q = @$db->query('SELECT requests FROM wpis WHERE id = 1');
        if ($q === false) {
			$db->query('CREATE TABLE wpis (id tinyint(4) NOT NULL, requests int, tresc text); INSERT INTO wpis (id, tresc) VALUES (1, "...");');
            $hits = 1;
        } else {
            $result = $q->fetchArray()[0];
            $hits = $result+1;
        }
        $db->query("UPDATE wpis SET requests = '$hits' WHERE id = 1");
    } else {
        die($err);
    }

	$this->db = $db;
	
}


public function pobierz($page){

	switch($page){

	case 'glowna':
	case 'admin':
  
		$query = "SELECT tresc FROM wpis WHERE id=1 LIMIT 1";
		$queryid = $this->db->query($query);
		if (!$queryid) die('Błąd odczytu z bazy danych: ' . lastErrorCode($this->db));
		$row = $queryid->fetchArray()[0];
		$tresc = stripslashes($row);

		break;

	case 'podstrona1':
	case 'podstrona2':
	case 'podstrona3':
	case 'podstrona4':
	case 'podstrona5':
	case 'podstrona6':
	case 'podstrona7':
	case 'podstrona8':
	case 'podstrona9':
		
		$tresc = "Wybrałeś: ".$page;       // Nazwa podstrony bedzie jej trescia
	}

	return $tresc;

}



public function zapisz($tresc){

	// Zapisanie nowej tresci
	$tresc = trim(strip_tags(addslashes($tresc)));
	$query = "UPDATE wpis SET tresc = '$tresc' WHERE id=1";
	$queryid = $this->db->query($query);
	if (!$queryid) die('Błąd zapisu do bazy danych: ' . lastErrorCode($queryid));
	Admin::$info = 'Zapisano.';

}

}
?>