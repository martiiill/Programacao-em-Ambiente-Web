
document.addEventListener("DOMContentLoaded", function () {

    var buttonS = document.getElementById("save").addEventListener("click", save);

    function save() {
        if (typeof (Storage) !== "undefined") {
            var localDoc = document.getElementById('doc');
            var localObservacao = document.getElementById('ob');

            var vDoc = localDoc.value;
            var vOb = localObservacao.value;

            localStorage.setItem('localDoc', JSON.stringify(vDoc));
            localStorage.setItem('locaObservacao', JSON.stringify(vOb));
        } else {
            window.alert("Não suporte do browser para o LocalStorage");
        }
    }
}, true);