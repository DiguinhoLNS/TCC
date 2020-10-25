/*******************************************************
	
	JS - Mask - V1

--------------------------------------------------------

	Todos os direitos reservados.
	Desenvolvido por APE Group. 
																					
*******************************************************/


/*******************************************************
    Mask
*******************************************************/

$(document).ready(function(){ 

    var $M_CPF = $(".InputCPF");
    var $M_CNPJ = $(".InputCNPJ");
    var $M_Telefone8 = $(".InputTelefone8");
    var $M_Telefone9 = $(".InputTelefone9");

    $M_CPF.mask('000.000.000-00', {reverse: true});

    $M_CNPJ.mask('00.000.000/0000-00', {reverse: true});

    $M_Telefone8.mask('(00) 0000-0000');

    $M_Telefone9.focusout(function(){

        var phone, element;

        element = $(this);
        element.unmask();
        
        phone = element.val().replace(/\D/g, '');

        if (phone.length > 10) {

            element.mask("(99) 99999-9999");

        } else {

            element.mask("(99) 9999-9999?9");

        }

    }).trigger('focusout');

});