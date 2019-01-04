<?php
# Dokument zum Bestellen der Pyramide
# | Version |Datum      |Autor            | Bemerkung
# |_________|___________|_________________|_________________
# | 1.0     |05.12.18   |Albani           | Neuerstellung

require('DBkonfiguration.php');
require('header.php');
include('image.php');
session_start();

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
  <?php if (isset($_SESSION['userid'])) {
    $statement = $dbconn->prepare("SELECT * FROM kunde, users WHERE kunde.id = users.kundenid AND users.id = :userid");
    $execute = $statement->execute(array('userid' => $_SESSION['userid']));
    $kunde = $statement->fetch(PDO::FETCH_ASSOC);
    ?>
    <p>Sind diese Informationen korrekt?</p>
    <h2>Kontaktdaten</h2>
    <p>Name: <input type="text" name="name" value="<?php echo $kunde['Name']?>" /></p>
    <p>Vorname: <input type="text" name="vorname" value="<?php echo $kunde['Vorname']?>"/></p>
    <p>Straße & Hausnummer: <input type="text" value="<?php echo $kunde['Strasse']?>" name="strasse" /></p>
    <p>PLZ: <input type="text" value="<?php echo $kunde['PLZ']?>" name="plz" /></p>
    <p>Ort: <input type="text" value="<?php echo $kunde['Ort']?>" name="ort" /></p>
    <p>E-Mail: <input type="text" value="<?php echo $kunde['EMail']?>" name="email" /></p>
    <p>Telefon: <input type="text" value="<?php echo $kunde['Telefon']?>" name="telefon" /></p>
<?php } else { ?>
  <p><a href="login.php"> Melden Sie sich an</a></p>
    <p>Für die Bestellung benötigen wir noch einige Informationen von Ihnen</p>
    <h2>Kontaktdaten</h2>
    <p>Name: <input type="text" name="name" placeholder="Adenauer" /></p>
    <p>Vorname: <input type="text" placeholder="Konrad" name="vorname"/></p>
    <p>Straße & Hausnummer: <input type="text" placeholder="Am Dom 1" name="strasse" /></p>
    <p>PLZ: <input type="text" placeholder="50676" name="plz" /></p>
    <p>Ort: <input type="text" placeholder="Köln" name="ort" /></p>
    <p>E-Mail: <input type="text" placeholder="konrad.adenauer@koeln.de" name="email" /></p>
    <p>Telefon: <input type="text" placeholder="0800 12345678" name="telefon" /></p>
<?php } ?>
    <input type="hidden" value="<?php echo $result['ID'];?>" name="produktid"/>
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
