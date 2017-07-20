
function id(el) {
    return document.getElementById(el);
}
function mostra(element) {
    if (element.value) {
        id(element.value).style.display = 'block';
    }
}
function esconde_todos($element, tagName) {
    var $elements = $element.getElementsByTagName(tagName), i = $elements.length;
    while (i--) {
        $elements[i].style.display = 'none';
    }
}

window.addEventListener('load', function () {
    var $Masculino = id('Users'), $Feminino = id('Geral'), $sexo = id('tipo-partilha');

    //mostrando no onload da página
    esconde_todos(id('palco'), 'div');
    mostra($sexo);

    //mostrando ao mudarr
    $sexo.addEventListener('change', function () {
        esconde_todos(document.getElementById('palco'), 'div');
        mostra(this);
    });
});


