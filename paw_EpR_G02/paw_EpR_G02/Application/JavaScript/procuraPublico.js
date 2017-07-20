function autoComplete(string) {
    // fire the ajax call and do something with the returned json string
    $.ajax({
        type: "GET",
        url: "PesquisarDados.php",
        data: "string=" + string,
        dataType: "json",
        success: function (returnedObj) {
            var rows = '';

            for (var key in returnedObj) {
                rows += "<option value='" + returnedObj[key] + "'></option>";
            }
            $("#target").html(rows);
        }
    });
}

function autoCompleteA(string) {
    // fire the ajax call and do something with the returned json string
    $.ajax({
        type: "GET",
        url: "PesquisarDadosAutor.php",
        data: "stringA=" + string,
        dataType: "json",
        success: function (returnedObj) {
            var rows = '';

            for (var key in returnedObj) {
                rows += "<option value='" + returnedObj[key] + "'></option>";
            }
            $("#targetA").html(rows);
        }
    });
}

$(document).ready(function () {
    $("#name").val("");
    $("#name").keypress(function () {
        autoComplete($("#name").val());
    });
});

$(document).ready(function () {
    $("#nameA").val("");
    $("#nameA").keypress(function () {
        autoCompleteA($("#nameA").val());
    });
});