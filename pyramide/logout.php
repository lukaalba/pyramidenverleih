<?php
session_start();
require('header.php');
require('footer.php');
if(isset($_POST['logout'])){
session_destroy();
echo 'Logout erfolgreich. <a href="index.php">Zur Startseite</a>';
}
?>