/* Javascript für die PHP-Suche
# | Version | Datum   | Autor            | Bemerkung
# |_________|_________|__________________|_________________
# | 1.0     |25.11.18 | Albani           | Neuerstellung
# | 1.1     |27.11.18 | Albani           | Hinzufügen Kategoriebutton zum Suchen aller verfügbaren Produkttypen
*/

function search_with_return() {

    var input = document.getElementById("SuchLeiste");
    input.addEventListener("keyup", function(event)
    {
       if (event.keyCode == 13)
    {
       search(input.value);
    }
    });
}

// Ajax
function show_reco(str) {

      if (str.length == 0) {
        document.getElementById("txtreco").innerHTML = "";
        document.getElementById("txtreco").style.display = "none";
      return;
      }
      else
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("txtreco").innerHTML = this.responseText;
            document.getElementById("txtreco").style.display = "block";
          }
        };
        xmlhttp.open("GET", "getProduct.php?q=" + str, true);
        xmlhttp.send();
        }
      }


function search(para) {
  var kat = document.getElementById("KatButton").innerHTML;

  if (para.length > 0) {
    window.location.href = "search.php?rq=" + para + "-" + kat;
  }
}

function show_kat() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("Katreco").innerHTML = this.responseText;
      document.getElementById("Katreco").style.display = "block";
    }
  };
  xmlhttp.open("GET", "getProduct.php?q=", true);
  xmlhttp.send();
}

function destroy_innerhtml(id) {
  document.getElementById(id).style.display = "none";
}

function changeValue(wert) {
 var doc = document.getElementById("KatButton");

  if (wert.length == 0) {
    doc.innerHTML = "Kategorie";
  }
  else {
    doc.innerHTML = wert;
  }
}
