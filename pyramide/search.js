/* Javascript für die PHP-Suche
# | Version | Datum   | Autor            | Bemerkung
# |_________|_________|__________________|_________________
# | 1.0     |25.11.18 | Albani           | Neuerstellung
*/

// Ajax
function show_reco(str) {

  var input = document.getElementById("SuchLeiste");
  input.addEventListener("keyup", function(event)
  {
    if (event.keyCode == 13)
    {
      search(input.value);
    }
  });
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
  if (para.length > 0) {
    window.location.href = "search.php?rq=" + para;
    
  }
}
