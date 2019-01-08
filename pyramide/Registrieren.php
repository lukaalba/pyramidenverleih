<?php 
session_start();
require('header.php');
require('footer.php');
require_once('DBkonfiguration.php');
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Registrierung</title>    
</head> 
<body>
 
<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) {
    $error = false;
    $arr_kunde = array('name' => $_POST['name'],
                       'vorname' => $_POST['vorname'],
                       'plz' => $_POST['plz'],
                       'ort' => $_POST['ort'],
                       'strasse' => $_POST['strasse'],
                       'email' => $_POST['email'],
                       'telefon' => $_POST['telefon']
                     );
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
  
    if(!filter_var($arr_kunde['email'], FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }     
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }
    
    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) { 
        // Überprüfe, ob E-Mail bereits von Gast verwendet wurde
        $statement = $dbconn->prepare("SELECT * FROM kunde WHERE email = :email");
        $result = $statement->execute(array('email' => $arr_kunde['email']));
        $gast = $statement->fetch(PDO::FETCH_ASSOC);
        
        if($gast) {
            // Überprüfe, ob es für die E-Mail bereits ein Userkonto gibt
            $statement = $dbconn->prepare("SELECT * FROM users WHERE kundenid = :user");
            $result = $statement->execute(array('user' => $gast['ID']));
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
                $error = true;
            }
            else {
                $arr_kunde += array('id' => $gast['ID']);
                $statement = $dbconn->prepare("UPDATE kunde SET name = :name, vorname = :vorname, plz = :plz, ort = :ort, strasse = :strasse, email = :email, telefon = :telefon WHERE id = :id");
                $result = $statement->execute($arr_kunde);
                if (!$result) {
                    echo 'Entschuldigung. Es gab einen Fehler beim Anlegen Ihres Benutzers. Bitte kontaktieren Sie uns.';
                    $error = true;
                } else {
                $id = $gast['ID'];
                }
            }
        }
     
        else {
            $sql_kunde = $dbconn->prepare("INSERT INTO Kunde (Name, Vorname, PLZ, Ort, Strasse, EMail, Telefon) 
            VALUES (:name, :vorname, :plz, :ort, :strasse, :email, :telefon)");
            $result = $sql_kunde->execute($arr_kunde);
            if (!$result) {
                echo 'Entschuldigung. Es gab einen Fehler beim Anlegen Ihres Benutzers. Bitte kontaktieren Sie uns.';
                $error = true;
            }
            else {
               $id = $dbconn->lastinsertId();
            }
        }
    
    }
    
    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {    
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $dbconn->prepare("INSERT INTO users (kundenid, passwort) VALUES  (:kundenid, :passwort)");
        $result = $statement->execute(array('kundenid' => $id, 'passwort' => $passwort_hash));
        if($result) {        
            echo 'Sie wurden erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    } 
}
 
if($showFormular) {
?>
<p>Wir freuen uns, dass Sie sich bei uns als Kunde registrieren wollen. Wir benötigen noch ein paar Informationen über Sie und dann kann es schon losgehen!</p>
<form action="?register=1" method="post">
Name:<br>
 <input type="text" size="40" name="name" placeholder="Adenauer" /><br><br>
Vorname:<br>
 <input type="text" size="40" placeholder="Konrad" name="vorname"/><br><br>
Straße & Hausnummer:<br>
 <input type="text" size="40" placeholder="Am Dom 1" name="strasse" /><br><br>
PLZ:<br>
 <input type="text" size="40" placeholder="50676" name="plz" /><br><br>
Ort:<br>
 <input type="text" size="40" placeholder="Köln" name="ort" /><br><br>
Telefon:<br>
 <input type="text" size="40" placeholder="0800 12345678" name="telefon" /><br><br>
E-Mail:<br>
<input type="email" size="40" placeholder="konrad@adenauer.de" maxlength="250" name="email"><br><br>
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>
Passwort wiederholen:<br>
<input type="password" size="40" maxlength="250" name="passwort2"><br><br>
 
<input type="submit" value="Abschicken">
</form>
 
<?php
} //Ende von if($showFormular)
?>
 
</body>
</html>