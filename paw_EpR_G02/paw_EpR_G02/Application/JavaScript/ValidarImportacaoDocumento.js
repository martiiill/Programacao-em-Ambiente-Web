
var d = document.getElementById("addDocImport_form");
d.addEventListener("click", validaAddDoc);

function validaAddDoc() {
    var sucesso = true;
    var dataCriacao = /^(\d{4})\-(\d{2})\-(\d{2})$/;
    var date = new Date().toJSON().slice(0, 10).replace(/-/g, '/');  //data de hoje

    if (document.getElementById('titulo').value === "") {
        document.getElementById('tituloValidationMessage').innerHTML = "Tem de preencher.";
        sucesso = false;
    } else if (document.getElementById('titulo').length < 90) {
        document.getElementById('tituloValidationMessage').innerHTML = "Titulo tem de ter menos de 90 caracteres";
        sucesso = false;
    } else if (!dataCriacao.exec(document.getElementById('dataCriacao').value)) {
        document.getElementById('dataCriacaoValidationMessage').innerHTML = "formato invalido (yyyy-mm-dd)";
        sucesso = false;
    } else if (dataCriacao.exec(document.getElementById('dataCriacao').value < date)) {
        document.getElementById('dataCriacaoValidationMessage').innerHTML = "a data tem de ser menor que a data de hoje";
        sucesso = false;
    } else if (document.getElementById('resumo').value === "") {
        document.getElementById('resumoValidationMessage').innerHTML = "tem de preencher este campo";
        sucesso = false;
    } else if (document.getElementById('coprto').value === "") {
        document.getElementById('corpoValidationMessage').innerHTML = "Corpo tem de ter menos de 200 caracteres";
        sucesso = false;
    } else if (document.getElementById('resumo').length < 100) {
        document.getElementById('tituloValidationMessage').innerHTML = "Resumo tem de ter menos de 100 caracteres";
        sucesso = false;
    } else if (document.getElementById('tipo-partilha').value === "") {
        document.getElementById('partilhaValidationMessage').innerHTML = "tem de preencher este campo";
        sucesso = false;
    } else if (document.getElementById('palavraChave').value === "") {
        document.getElementById('palavraChaveValidationMessage').innerHTML = "tem de preencher este campo";
        sucesso = false;
    } else if (document.getElementById('url').value === "") {
        document.getElementById('urlValidationMessage').innerHTML = "tem de preencher este campo";
        sucesso = false;
    } else if (document.getElementById('permissao').value === "0" || document.getElementById('permissao').value === "1") {
        document.getElementById('palavraChaveValidationMessage').innerHTML = "1 para sim, 0 para nao";
        sucesso = false;
    }
    return sucesso;
}