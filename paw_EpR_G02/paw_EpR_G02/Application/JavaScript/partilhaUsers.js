$(document).ready(function () {
    var max_fields = 5; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<label>Username ' + x + '<input type="text" name="mytext[]"/><input type="button" value="Remover" class="remove_field"></label><br>'); //add input box
        }
    });

    $('.remove_field').live('click',function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent().remove('label');
        x--;
    });
});