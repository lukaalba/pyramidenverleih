<!-- Seite für Suchergebnisse (PHP)
# | Version | Datum   | Autor            | Bemerkung
# |_________|_________|__________________|_________________
# | 1.0     |25.11.18 | Albani           | Neuerstellung

--->
<?php

require_once ('DBkonfiguration.php');
global $dbconn;
include('image.php');
$req = $_REQUEST['rq'];

$req = str_replace('ö', 'o', $req );
$req = str_replace('ä', 'a', $req );
$req = str_replace('ü', 'u', $req );

$cond = explode("-", $req);

If ($cond[1] == "Alle")
{
  $cond[1] = "%";
}

require('header.php');?>

<script>document.getElementById("SuchLeiste").value ="<?php echo $cond[0];?>";</script>

<?php
#Select Statement
$query = $dbconn->prepare("SELECT * FROM Produkte WHERE Bezeichnung LIKE '$cond[0]%' AND Typ LIKE '$cond[1]'");
?> <h2>Suchergebnisse</h2><?php

# Führt das Select Statement aus
function sqlexec($sql) {
$sql->execute();
$i = 0;
 while ($result= $sql->fetch(PDO::FETCH_ASSOC)) {
  $i++;
 ?>

 <div class="ergebnis"><table>
   <link href="search.css" rel="stylesheet" type="text/css"/>
     <tr>
       <td class="img"><?php getImage($result['ID'], 1)?></td>
       <td class="prodtext" onclick="window.location.replace('detail.php?id=<?php echo $result['ID']; ?>')"><b>Name: <?php print utf8_encode($result['Bezeichnung']);?></b><br />
       Größe: <?php print $result['Groesse'];?><br />
       Versand: <?php print $result['Versand'];?><br />
       <p class="preis">Preis: <?php print $result['Preis'];?> €</p></td></tr></table></div>

<?php
}
return $i;
}
#Überprüfung, ob etwas gefunden wurde
if (sqlexec($query) == 0)
{
  ?> <p>Keine eindeutige Übereinstimmung</p>
  <h2>Suchergebnisse ähnlich Ihres Suchbegriffs</h2>
  <?php
  $query = $dbconn->prepare("SELECT * FROM Produkte WHERE Bezeichnung LIKE '%$cond[0]%'");

  if (sqlexec($query) == 0) {?>
    <p>Keine Übereinstimmung mit Artikeln gefunden</p>
  <h2>Wir konnten Ihren Artikel leider nicht finden</h2>
<?php
}
}
$dbconn = null;

require('footer.php');
?>
