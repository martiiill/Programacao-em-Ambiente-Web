
var d = document.getElementById("addOb_form");
d.addEventListener("click", validaAddObs);


function validaAddObs() {
    var sucesso = true;
  
    if (document.getElementById('ob').value === "") {
        document.getElementById('nomeObValidation').innerHTML = "Tem de preencher este campo.";
        sucesso = false;
    }

    return sucesso;
}