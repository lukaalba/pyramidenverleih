<?php
# Backendskript für das Darstellen von Bildern
# | Version |Datum    |Autor            | Bemerkung
# |_________|_________|_________________|_________________
# | 1.0     |25.11.18 | Albani          | Neuerstellung
# | 1.1     |02.12.18 | Albani          | Bilder werden jetzt über Pfade angegeben und nicht über Longblobs


function getImage($reqid, $g) {

global $dbconn;
$query = $dbconn->prepare("SELECT * FROM Bilder WHERE ProdukteID = $reqid");
$query->execute();
$i = 0;
while (($data = $query->fetch(PDO::FETCH_ASSOC)) && ($i < $g))
{
  $i++;
  echo "<img src= '" . $data['Pfad'] . "' id='" . $data['ID'] . "'>";
}
}


 ?>
