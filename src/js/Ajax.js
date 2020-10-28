/*******************************************************
	
	JS - Ajax - V1

--------------------------------------------------------

	Todos os direitos reservados.
	Desenvolvido por APE Group. 
																					
*******************************************************/


/*******************************************************
    Cookies
*******************************************************/

$(document).ready(function(){

    // ConsoleLog txt
    function AJAXRequestStatus($s){

        if($s == "0"){

            console.log("Requisição AJAX foi mal sucedida");

        }

        if($s == "1"){

            console.log("Requisição AJAX foi bem sucedida");

        }

    }

    // Deny Cookies
    function DenyCookies(){

        $.ajax("php/cookies/DenyCookies.php",{

        }).done(function(){

            AJAXRequestStatus(1);

        }).fail(function(){

            AJAXRequestStatus(0);

        });

    }

    // Allow Cookies
    function AllowCookies(){

        $.ajax("php/cookies/AllowCookies.php",{

        }).done(function(){

            AJAXRequestStatus(1);

        }).fail(function(){

            AJAXRequestStatus(0);

        });

    }

    // Deny Cookies
    $(".CookiesOFF").click(function(){

        DenyCookies();

    });

    // Allow Cookies
    $(".CookiesON").click(function(){

        AllowCookies();

    });

    // Notification
    $("#ClearNotifications").click(function(){

        $.ajax("php/cookies/Notification.php",{

        }).done(function(){

            AJAXRequestStatus(1);

        }).fail(function(){

            AJAXRequestStatus(0);

        });

    });

});

/*******************************************************
    Feed
*******************************************************/

$(document).ready(function(){

    const ItemBox = $(".ItemBox");

    /* Filtes */

    // A-Z
    $("#P1").on("click", function(){

        ItemBox.remove();

    });

    // Z-A
    $("#P2").on("click", function(){

        ItemBox.remove();

    });

    // Data >
    $("#P3").on("click", function(){

        ItemBox.remove();

    });

    // Data <
    $("#P4").on("click", function(){

        ItemBox.remove();

    });

    /* Search Bar */

    $("#FeedSearchItens").keyup(function(){

        ItemBox.remove();
        
    });

});