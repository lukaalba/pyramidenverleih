<!DOCTYPE html>
<html>
    <head>
        <title>Cheops GmbH - Home</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" charset="utf-16">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <link href="home.css" rel="stylesheet" type="text/css"/>
        <script src="script.js"></script>
        <script src="search.js"></script>
    </head>
    <body>
        <header>
            <div id="SuchHeader">
                <img src="images/PyramidenVerleihIcon.png" id="icon" onclick="window.location.replace('index.php')" onmouseover="changeMouse(this.id)">
                <div id="KatButton" onmouseover="changeMouse(this.id)" onclick="show_kat('')">Alle</div>
                <input id="SuchLeiste" placeholder="Suche..." onkeyup="show_reco(this.value)" onkeydown="search_with_return()" />
                <div class="headerButton" id="RegistrierenButton" onmouseover="changeMouse(this.id)">
                    <div class="ButtonText">Registrieren</div>
                </div>
                <div class="headerButton" id="AnmeldenButton" onmouseover="changeMouse(this.id)">
                    <div class="ButtonText">Anmelden</div>
                </div>
            </div>
            <div id = "Katreco" onmouseleave="destroy_innerhtml('Katreco')"></div>
            <div id ="txtreco" onmouseleave="destroy_innerhtml(this.id)"></div>
            <div id="KategorieHeader">
                <a href="index.php"><div class="tab" id="HomeTab" onmouseover="changeMouse(this.id)">Home</div></a>
                <a href="produkte.php"><div class="tab" id="ProdukteTab" onmouseover="changeMouse(this.id)">Produkte</div></a>
                <a href="sonderangebote.php"><div class="tab" id="SonderangeboteTab" onmouseover="changeMouse(this.id)">Sonderangebote</div></a>
                <a href="kontakt.php"><div class="tab" id="KontaktTab" onmouseover="changeMouse(this.id)">Kontakt</div></a>
            </div>
        </header>

        <!-- Box, um den Seiteninhalt unter die Kopfzeile zu schieben -->
        <div id="spacingBoxTop"></div>
    </body>
</html>
