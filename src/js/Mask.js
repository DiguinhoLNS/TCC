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

    // Register

        // User

        var $RUserCPF = $("#R_UserCPF");
        var $RUserPhone = $("#R_UserTelefone");

        $RUserCPF.mask('000.000.000-00', {reverse: true});
        $RUserPhone.focusout(function(){

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

        // Company
          
        var $RCompanyCNPJ = $("#R_CompanyCNPJ");
        var $RCompanyPhone = $("#R_CompanyTelefone");

        $RCompanyCNPJ.mask('00.000.000/0000-00', {reverse: true});
        $RCompanyPhone.mask('(00) 0000-0000');

});