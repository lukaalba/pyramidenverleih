<?php
# Backendskript für das Darstellen von Bildern
# | Version |Datum    |Autor            | Bemerkung
# |_________|_________|_________________|_________________
# | 1.0     |20.11.18 | Albani          | Neuerstellung

  require_once ('DBkonfiguration.php');

$reqid = $_REQUEST['id'];

try {


# Stellt Verbindung zur Datenbank her
$dbconn = new PDO('mysql:host='. MYSQL_HOST . ';dbname=' . MYSQL_DATENBANK, MYSQL_BENUTZER, MYSQL_KENNWORT);

} catch  (PDOException $e) {
  print  "Error!: " . $e->getMessage() . "<br />";

#exit
  die();
}

$query = $dbconn->prepare("SELECT * FROM Bilder WHERE ProdukteID = $reqid");
$query->execute();
$data = $query->fetch(PDO::FETCH_ASSOC);

if(empty($data))
  header("HTTP/1.0 404 Not Found");
else {
  header('Content-type:' . $data['Datentyp']);
  echo $data['Bilddatei'];
}


$dbconn = null;
 ?>
