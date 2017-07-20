
var d = document.getElementById("addDoc_form");
d.addEventListener("click", validaAddDoc);


function validaAddDoc() {
    var sucesso = true;
    var dataCriacao = /^(\d{4})\-(\d{2})\-(\d{2})$/;

    if (document.getElementById('titulo').value === "") {
        document.getElementById('tituloValidationMessage').innerHTML = "Tem de preencher.";
        sucesso = false;
    } else if (!dataCriacao.exec(document.getElementById('dataCriacao').value)) {
        document.getElementById('dataCriacaoValidationMessage').innerHTML = "formato invalido (yyyy-mm-dd)";
        sucesso = false;

    } else if (document.getElementById('corpo').value === "") {
        document.getElementById('corpoValidationMessage').innerHTML = "tem de preencher este campo";
        sucesso = false;

    } else if (document.getElementById('resumo').value === "") {
        document.getElementById('resumoValidationMessage').innerHTML = "tem de preencher este campo";
        sucesso = false;
    } else if (document.getElementById('autor').value === "") {
        document.getElementById('autorValidationMessage').innerHTML = "tem de preencher este campo";
        sucesso = false;
    } else if (document.getElementById('partilha').value === "") {
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