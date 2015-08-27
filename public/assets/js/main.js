/**
 * Created by motillaPalace on 26/08/2015.
 */

$( document ).ready(function() {
    $("input#form_ficha_submit").click(function( event ) {
        var iban = $("input#form_iban").val();
        if(iban != '' && !IBAN.isValid(iban)) {
            alert("Por favor, revisa el código IBAN del cliente que no parece ser válido.");
            return false;
        }
        return true;
    });
});
