
var highScoreO = localStorage.getItem("locaObservacao");
var doc = localStorage.getItem("localDoc");

if (highScoreO) {
    document.getElementById('Ob').innerHTML = "Observação: " + highScoreO;
} else {
    document.getElementById('Ob').innerHTML = "";
}
