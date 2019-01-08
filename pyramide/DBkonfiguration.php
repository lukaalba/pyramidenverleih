<?php
// Version 1.0: Rohling erstellt, der Einstellungen für DB-Zugriff regelt; @Hassfeld
// Version 1.1: Skript stellt jetzt auch direkt die Verbindung zur Datenbank her; @Albani

//PHP-Dateien, die ausgelagert wurden, hier einbinden per require_once


// Damit alle Fehler angezeigt werden
error_reporting(E_ALL);

//Zum Aufbau der Verbindung zur Datenbank
define ( "MYSQL_HOST", "localhost");

//Benutzer für die Datenbank festlegen (auf die DB)
define ( 'MYSQL_BENUTZER', 'root');
define ( 'MYSQL_KENNWORT', '');

//Name der DB
define ( 'MYSQL_DATENBANK', 'Pyramidenverleih');

// Stellt Verbindung zur Datenbank her
try {
  $dbconn = new PDO('mysql:host='. MYSQL_HOST . ';dbname=' . MYSQL_DATENBANK, MYSQL_BENUTZER, MYSQL_KENNWORT);
} catch  (PDOException $e) {
  print  "Error!: " . $e->getMessage() . "<br />";

#exit
  die();
}

?>
