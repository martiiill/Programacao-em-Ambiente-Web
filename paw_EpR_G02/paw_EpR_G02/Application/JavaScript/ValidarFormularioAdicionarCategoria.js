
var d = document.getElementById("adicionarCategoriaFormulario");
d.addEventListener("click", validarAdicionarCategoriaFormulario);


function validarAdicionarCategoriaFormulario() {
    var sucesso = true;

    if (document.getElementById('idCategoria').value < 1) {
        document.getElementById('idCategoriaValidationMessage').innerHTML = "o id deve ser maior do que zero(0)";
        sucesso = false;
    } else if (document.getElementById('idCategoria').value === "") {
        document.getElementById('idCategoriaValidationMessage').innerHTML = "este campo é de preenchimento obrigatorio";
        sucesso = false;
    } else if (document.getElementById('nomeCategoria').value === "") {
        document.getElementById('nomeCategoriaValidationMessage').innerHTML = "este campo é de preenchimento obrigatorio";
        sucesso = false;
    }
    return sucesso;
}