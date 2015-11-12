/**
 * Created by motillaPalace on 26/08/2015.
 */

$( document ).ready(function() {
    $("button#form_ficha_submit").click(function( event ) {
        var iban = $("input#form_iban").val();
        if(iban != '' && !IBAN.isValid(iban)) {
            alert("Por favor, revisa el código IBAN del cliente que no parece ser válido.");
            return false;
        }
        return true;
    });

    /* for mailing */
   /* $("select#mails_cliente").change(function(){
        var idcliente = $(this.selectedOptions)[0].value;
        var datos = {"idcliente":idcliente};
        $.ajax({
            type: "POST",
            url: "../personal/index",
            data: datos,
            dataType: "json",
            cache: false
        }).done(function(data) {
            alert("SUCCESSS!");
        }).fail(function(data) {
            alert("ERROR: no se han podido obtener los correos electrónicos de las personas asociadas a la empresa seleccionada.\n\nPor favor, asegúrate de que existen en el sistema.");
        });
    });*/
});
