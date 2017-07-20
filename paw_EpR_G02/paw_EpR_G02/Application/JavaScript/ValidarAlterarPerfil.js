
var d = document.getElementById("formAlterarPerfil");
d.addEventListener("click", validarAlterarPerfil);


function validarAlterarPerfil() {
    var sucesso = true;

    if (document.getElementById('nome').value === "") {
        document.getElementById('nomeValidationMessage').innerHTML = "tem de preencher este campo";
        sucesso = false;
    } else if (document.getElementById('morada').value === " ") {
        document.getElementById('moradaValidationMessage').innerHTML = "tem de preencher este campo";
        sucesso = false;
    } else if (document.getElementById('contacto').value === " ") {
        document.getElementById('contactoValidationMessage').innerHTML = "tem de preencher este campo";
        sucesso = false;
    }
    return sucesso;
}