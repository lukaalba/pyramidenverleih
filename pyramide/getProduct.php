<?php
# Backendskript für die Bereitstellung der Ajax Suche
# | Version |Datum    |Autor            | Bemerkung
# |_________|_________|_________________|_________________
# | 1.0     |20.11.18 |Hassfeld, Albani | Neuerstellung
# | 1.1     |25.11.18 |Albani           | Anpassung der Ausgabe
# | 1.2     |27.11.18 |Albani           | Hinzufügen eines Produkt-Kategoriebuttons
# | 1.3     |03.12.18 |Albani           | Kategorie kann jetzt Umlaute darstellen

# Importiert Konstanten aus Konfigurationsdatei
require_once ('DBkonfiguration.php');

$q = $_REQUEST["q"];

$q = str_replace('ö', 'o', $q ); #Datenbank findet keine Umlaute, daher muss hier manuell Umlaute ersetzt werden
$q = str_replace('ä', 'a', $q );
$q = str_replace('ü', 'u', $q );
$hint = "";
$i = 0;
$cond = explode("-", $q);


# Bei Öffnen des Kategorie Buttons bleibt $q leer, womit diese Option herausgefiltert werden kann
if (strlen($q) == 0)
{
$sql = $dbconn->prepare("SELECT DISTINCT Typ FROM Produkte");

$sql->execute();
  $ausgabe = "<ul><li onclick='changeValue(`Alle`)'>Alle</li>";

while ($hint = $sql->fetch(PDO::FETCH_ASSOC)) {
  $i++;
  $ausgabe .= "<li onclick='changeValue(`" . $hint['Typ'] . "`)'>" . utf8_encode($hint['Typ']) . "</li>";

}
  $ausgabe .= "</ul>";
}
else { #hier kommt der Ablauf des Suchfeldes
#Select Statement
If ($cond[1] == "Alle")
{
  $cond[1] = "%";
}
$sql = $dbconn->prepare("SELECT * FROM Produkte WHERE Bezeichnung LIKE '$cond[0]%' AND Typ LIKE '$cond[1]'");

# Führt das Select Statement aus
$sql->execute();

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

}
echo $ausgabe;

# Schließt die Datenbankverbindung
$dbconn = null;

?>
