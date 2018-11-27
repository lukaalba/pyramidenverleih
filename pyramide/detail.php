<?php

require('header.php');
require_once ('DBkonfiguration.php');
$que = $_REQUEST['id'];

# Stellt Verbindung zur Datenbank her
$dbconn = new PDO('mysql:host='. MYSQL_HOST . ';dbname=' . MYSQL_DATENBANK, MYSQL_BENUTZER, MYSQL_KENNWORT);

$sql = $dbconn->prepare("SELECT * FROM Produkte WHERE ID = $que");

$sql->execute();
$i = 0;
 while ($result= $sql->fetch(PDO::FETCH_ASSOC)) {
 ?>
 <link href="detail.css" rel="stylesheet" type="text/css">
 <div class="ergebnis"><table>
     <tr>
       <td id="img"><img width="500" height="500" src="image.php?id=<?php echo $result['ID'];?>"></td>
       <td id="prodtext" onclick="window.location.replace('detail.php?id=<?php echo $result['ID']; ?>')"><h1>Name: <?php print utf8_encode($result['Bezeichnung']);?></h1><br />
       Größe: <?php print $result['Groesse'];?><br />
       Versand: <?php print $result['Versand'];?><br />
       <p id="preis">Preis: <?php print $result['Preis'];?> €</p></td></tr></table></div>
<?php
}

$dbconn = null;

require('footer.php');
?>
