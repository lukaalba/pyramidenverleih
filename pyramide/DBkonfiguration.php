<?php
// Version 1.0: Rohling erstellt, der Einstellungen für DB-Zugriff regelt; @Hassfeld

//PHP-Dateien, die ausgelagert wurden, hier einbinden per require_once


// Damit alle Fehler angezeigt werden
error_reporting(E_ALL);

//Zum Aufbau der Verbindung zur Datenbank
//Daten müssen noch hinzugefügt werden, ist lediglich Rohling
define ( "MYSQL_HOST", "localhost");

//Benutzer für die Datenbank festlegen (auf die DB), Benutzer von XAMPP rausfinden
define ( 'MYSQL_BENUTZER', 'root');
define ( 'MYSQL_KENNWORT', '');

//Name der DB
define ( 'MYSQL_DATENBANK', 'Pyramidenverleih');
?>
