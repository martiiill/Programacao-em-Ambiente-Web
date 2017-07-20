function autoComplete(string) {
    // fire the ajax call and do something with the returned json string
    $.ajax({
        type: "GET",
        url: "PesquisarDadosUtilizador.php",
        data: "string=" + string,
        dataType: "json",
        success: function (returnedObj) {
            var rows = '';

            for (var key in returnedObj) {
                rows += "<option value='" + returnedObj[key] + "'></option>";
            }
            $("#targetU").html(rows);
        }
    });
}



function autoCompleteA(string) {
    // fire the ajax call and do something with the returned json string
    $.ajax({
        type: "GET",
        url: "PesquisarDadosAutorUtilizador.php",
        data: "stringA=" + string,
        dataType: "json",
        success: function (returnedObj) {
            var rows = '';

            for (var key in returnedObj) {
                rows += "<option value='" + returnedObj[key] + "'></option>";
            }
            $("#targetUA").html(rows);
        }
    });
}

$(document).ready(function () {
    $("#nameU").val("");
    $("#nameU").keypress(function () {
        autoComplete($("#nameU").val());
    });
});

$(document).ready(function () {
    $("#nameUA").val("");
    $("#nameUA").keypress(function () {
        autoCompleteA($("#nameUA").val());
    });
});