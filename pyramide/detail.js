/* Javascript Funktionen für die Seite "details.php"

# | Version |Datum      |Autor            | Bemerkung
# |_________|___________|_________________|_________________
# | 1.0     |03.12.2018 |Albani           | Neuerstellung

*/
// Ermöglicht onclick Funktionen auf die Bilder
function setOnClick() {
  var x = document.getElementById("imageid").getElementsByTagName("img");
  for (i = 0; i < x.length; i++) {
    x[i].setAttribute("onclick", "setActive(this.id)")
  }
}

// setzt das angeklickte Bild auf aktiv, sodass es groß dargestellt wird
function setActive(id) {
  var path = document.getElementById(id).getAttribute("src");
  document.getElementById("active").setAttribute("src", path);
}
