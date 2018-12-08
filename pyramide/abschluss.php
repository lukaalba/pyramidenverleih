<?
# Fügt Bestellung in Datensatz ein und sendet Bestätigung an Kunden
# | Version |Datum      |Autor            | Bemerkung
# |_________|___________|_________________|_________________
# | 1.0     |08.12.18   |Albani           | Neuerstellung

require_once('DBkonfiguration.php');
require('header.php');
$pos_id = $_POST['produktid'];
$kunden_email = $_POST['email'];
#Überprüfung Kunde
$search = $dbconn->prepare("SELECT * FROM Kunde WHERE EMail = '$kunden_email'");
$search->execute();
$result = $search->fetch(PDO::FETCH_ASSOC);

if (!isset($result))
{

# Insert Kunde
$arr_kunde = array('name' => $_POST['name'],
                       'vorname' => $_POST['vorname'],
                       'plz' => $_POST['plz'],
                       'ort' => $_POST['ort'],
                       'strasse' => $_POST['strasse'],
                       'email' => $_POST['email'],
                       'telefon' => $_POST['telefon']
                     );
$sql_kunde = "INSERT INTO Kunde (Name, Vorname, PLZ, Ort, Strasse, EMail, Telefon) VALUES (:name, :vorname, :plz, :ort, :strasse, :email, :telefon)";
$id_kunde = insert_into_db($sql_kunde, $arr_kunde);
}
else
{
$id_kunde = $result['ID'];
}

# Insert Bestellungen
$sql_bestellung = "INSERT INTO Bestellungen (KundeID, Beginn, Ende) VALUES (:kundeid, :beginn, :ende)";
$arr_bestellung = array('kundeid' => $id_kunde,
                       'beginn' => $_POST['beginn'],
                       'ende' => $_POST['ende']
                     );
$id_bestellung = insert_into_db($sql_bestellung, $arr_bestellung);

# Insert Positionen
$arr_position = array('produkteid' => $pos_id,
                     'bestellungid' => $id_bestellung,
                     'preis' => $_POST['gesamtpreis'],
                     'menge' => '1');
$sql_position = "INSERT INTO Positionen (ProdukteID, BestellungID, Preis, Menge) VALUES (:produkteid, :bestellungid, :preis, :menge)";
insert_into_db($sql_position, $arr_position);


function insert_into_db($sql, $array) {
  global $dbconn;
  $insert = $dbconn->prepare($sql);
  $insert->execute($array);
  $auto_id = $dbconn->lastInsertId();
  return $auto_id;
}
?>
<h2>Vielen Dank für Ihre Bestellung!</h2>
<p>Ihre Bestellung ist bei uns erfolgreich eingegangen. Ihre Bestellungsnummer lautet: <?php echo $id_bestellung;?></p>
<p>Sie erhalten in Kürze eine Bestätigungsmail von uns mit allen weiteren Informationen für Ihre Leihe.</p>
<p>Bei Fragen:
  <ul>
    <li>Unsere Hotline: 0800 12341233</li>
    <li>Nutzen Sie unser <a href="kontakt.php"> Kontaktformular</a></li>
  </ul>

<?php
require('footer.php');
 ?>
