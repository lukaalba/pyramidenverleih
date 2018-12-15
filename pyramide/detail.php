<?php
# Darstellung der Detailsuche
# | Version |Datum      |Autor            | Bemerkung
# |_________|___________|_________________|_________________
# | 1.0     |25.11.2018 |Albani           | Neuerstellung
# | 1.1     |03.12.2018 |Albani           | Darstellung mit CSS, mehrere Bilder können jetzt angezeigt werden

require('header.php');
require_once ('DBkonfiguration.php');
include('image.php');
$que = $_REQUEST['id'];

$sql = $dbconn->prepare("SELECT * FROM Produkte WHERE ID = $que");

$sql->execute();
$i = 0;
 while ($result= $sql->fetch(PDO::FETCH_ASSOC)) {
 ?>

 <link href="detail.css" rel="stylesheet" type="text/css">
 <script src="detail.js"></script>
 <script>
    document.getElementById("SuchLeiste").value ="<?php echo $result['Bezeichnung'];?>";
  </script>
  <div class="image" id="imageid">
    <img id="active" src="">
         <?php getImage($que, 2);
         ?>
  </div>
       <div class="prodtext">
         <h1><?php print utf8_encode($result['Bezeichnung']);?></h1>
       <p>Größe: <?php print $result['Groesse'];?> m<br /></p>
       <p>Versand: <?php print $result['Versand'];?> Sklaven</p>
       <p><?php print utf8_encode($result['Beschreibung']);?> </p>
       </div>
     <div class="preisinfo">
       <p>Auf Lager</p>
       <p id="werbetext">Bestellen Sie noch heute und erhalten Sie einen Gratis-Skarabäus dazu!</p>
       <div id="BestellButton" onmouseover="changeMouse(this.id)"><a href="bestellung.php?id=<?php echo $result['ID']?>">Jetzt bestellen</a></div>
       <p id="preis">Preis: <?php print $result['Preis'];?> €/Tag</p>
     </div>
     <div id="box"></div>
<script>
setActive(1);
setOnClick();
</script>
<?php
}

$dbconn = null;

require('footer.php');
?>
