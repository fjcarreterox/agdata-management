/**
 * Created by motillaPalace on 26/08/2015.
 */

$( document ).ready(function() {
    $("input#form_ficha_submit").click(function( event ) {
        if(!IBAN.isValid($("input#form_iban").val())) {
            alert("Por favor, revisa el código IBAN del cliente que no parece ser válido.");
            return false;
        }
        return true;
    });
});
