<?php
# Backendskript für die Bereitstellung der Ajax Suche
# | Version |Datum    |Autor            | Bemerkung
# |_________|_________|_________________|_________________
# | 1.0     |20.11.18 |Hassfeld, Albani | Neuerstellung
# | 1.1     |25.11.18 |Albani           | Anpassung der Ausgabe

# Importiert Konstanten aus Konfigurationsdatei
require_once ('DBkonfiguration.php');

try {


# Stellt Verbindung zur Datenbank her
$dbconn = new PDO('mysql:host='. MYSQL_HOST . ';dbname=' . MYSQL_DATENBANK, MYSQL_BENUTZER, MYSQL_KENNWORT);

} catch  (PDOException $e) {
  print  "Error!: " . $e->getMessage() . "<br />";

#exit
  die();
}


$q = $_REQUEST["q"];
$q = str_replace('ö', 'o', $q );
$q = str_replace('ä', 'a', $q );
$q = str_replace('ü', 'u', $q );
$hint = "";

#Select Statement
$sql = $dbconn->prepare("SELECT * FROM Produkte WHERE Bezeichnung LIKE '$q%'");

# Führt das Select Statement aus
$sql->execute();

$i = 0;

$ausgabe = "<table id='suchvor'>";

# Rückgabe jedes Treffers
while ($hint= $sql->fetch(PDO::FETCH_ASSOC)) {
  $i++;
  $ausgabe.="<tr id='". $hint['Bezeichnung']  . "' onclick='search(this.id)'><td>" . $hint['Bezeichnung'] . "</td></tr>";
  $ausgabe = utf8_encode($ausgabe);
}

if ($i == 0)
{
  $ausgabe .= "<tr><td>keine Vorschläge gefunden</td></tr>";
}

$ausgabe .= "</table>";


echo $ausgabe;

# Schließt die Datenbankverbindung
$dbconn = null;

?>
