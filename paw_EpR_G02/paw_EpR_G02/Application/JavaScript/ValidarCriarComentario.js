

var d = document.getElementById("addCom_form");
d.addEventListener("click", validarAdicionarComentario);


function validarAdicionarComentario() {
    var sucesso = true;

    if (document.getElementById('nome').value === "") {
        document.getElementById('nomeValidationMessage').innerHTML = "tem que ser prenchido";
        sucesso = false;
    } else if (document.getElementById('texto').value === "") {
        document.getElementById('textoValidationMessage').innerHTML =  "tem que ser prenchido";
        sucesso = false;
    } else if (document.getElementById('doc').value === "") {
        document.getElementById('docValidationMessage').innerHTML = "tem que ser prenchido";
        sucesso = false;
    }
    return sucesso;
}