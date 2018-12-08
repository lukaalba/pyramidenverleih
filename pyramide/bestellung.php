<?php
# Dokument zum Bestellen der Pyramide
# | Version |Datum      |Autor            | Bemerkung
# |_________|___________|_________________|_________________
# | 1.0     |05.12.18   |Albani           | Neuerstellung

require('DBkonfiguration.php');
require('header.php');
include('image.php');

$id = $_REQUEST["id"];

$product = $dbconn->prepare("SELECT * FROM Produkte WHERE ID = '$id'");

$product->execute();

$result = $product->fetch(PDO::FETCH_ASSOC);

?>
<link href="bestellung.css" rel="stylesheet" type="text/css"/>
<script src="bestellung.js"></script>
<div id="image"><?php getImage($id, 1);?></div>
<div id="headline"><b><?php echo $result['Bezeichnung'];?></b></div>
<div id="form">
  <form action="abschluss.php" method="POST">
    <input type="hidden" value="<?php echo $result['ID'];?>" name="produktid" />
    <p>Für die Bestellung benötigen wir noch einige Informationen von Ihnen</p>
    <h2>Kontaktdaten</h2>
    <p>Name: <input type="text" placeholder="Adenauer" name="name" /></p>
    <p>Vorname: <input type="text" placeholder="Konrad" name="vorname" /></p>
    <p>Straße & Hausnummer: <input type="text" placeholder="Am Dom 1" name="strasse" /></p>
    <p>PLZ: <input type="text" placeholder="50676" name="plz" /></p>
    <p>Ort: <input type="text" placeholder="Köln" name="ort" /></p>
    <p>E-Mail: <input type="text" placeholder="konrad.adenauer@koeln.de" name="email" /></p>
    <p>Telefon: <input type="text" placeholder="0800 12345678" name="telefon" /></p>
    <hr>
    <h2>Bestelldaten</h2>
    <p>Leihbeginn: <input id="beginn" type="date" placeholder="yyyy-mm-dd" name="beginn" onblur="dauerBerechnen(<?php echo $result['Preis']; ?>)"/></p>
    <div id="fehlermeldung"></div>
    <p>Leihende: <input id="ende" type="date" placeholder="yyyy-mm-dd" name="ende" onblur="dauerBerechnen(<?php echo $result['Preis']; ?>)"/></p>
    <p>Leihdauer: <span id="leihdauer">0</span> Tage</p>
    <p id="gp">Gesamtpreis: <input id="gesamtpreis" name="gesamtpreis" readonly/> €</p>
    <p><input id="submit" type="submit" value="Bestellen" /></p>

  </form>
</div>
<?php
require('footer.php');
 ?>
