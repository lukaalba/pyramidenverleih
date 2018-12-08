function dauerBerechnen(preis) {
var beg = document.getElementById("beginn").value;
var end = document.getElementById("ende").value;

if (beg != 0 && end !=0) {
  var day_ms = 1000*60*60*24;
  var beg_ms = Date.parse(beg);
  var end_ms = Date.parse(end);

if (beg_ms > end_ms) {
  document.getElementById("fehlermeldung").innerHTML = "Das Enddatum muss größer als das Startdatum sein";
  manipulateHTML (true, "red", "red");
}
else {
  var dif = end_ms - beg_ms;
  var dif = dif / day_ms;
  manipulateHTML (false, "white", "white");
  document.getElementById("fehlermeldung").innerHTML = "";
  document.getElementById("leihdauer").innerHTML =  dif ;
  document.getElementById("gesamtpreis").value = dif * preis;
}
}
}

function manipulateHTML (disable, sty_beginn, sty_ende) {
  document.getElementById("submit").disabled = disable;
  document.getElementById("beginn").style.backgroundColor = sty_beginn;
  document.getElementById("ende").style.backgroundColor = sty_ende;
}
