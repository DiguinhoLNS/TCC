/*******************************************************
	
	JS - Ajax - V1

--------------------------------------------------------

	Todos os direitos reservados.
	Desenvolvido por APE Group. 
																					
*******************************************************/


/*******************************************************
    AJAX
*******************************************************/


$(document).ready(function(){

    /*******************************************************
        Console Log
    *******************************************************/

    function AJAXRequestStatus($s){

        if($s == "0"){

            console.log("Requisição AJAX foi mal sucedida");

        }

        if($s == "1"){

            console.log("Requisição AJAX foi bem sucedida");

        }

    }

    /*******************************************************
        Cookies
    *******************************************************/

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

    /*******************************************************
        Feed
    *******************************************************/

    const FilterCategory = $(".FilterCategory");
    const FilterParamenter = $(".FilterParameter");

    var FeedAll = $("#FeedAll");
    var FeedCategory = $("#FeedCategory");

    var FeedFrame = localStorage.getItem("FeedFrame");

    /* Search Bar */

    $("#btnSearchFeed").on("click", function(){

        var pesquisa = $("#FeedSearchItens").val();

            var folder = `php/Filters/Search.php?q=${pesquisa}`;

            $(".ItemBox").remove();

            $.ajax({

                url : folder,
                type : 'get',

                beforeSend : function(){
                    
                    $(".ItemBox").remove();
                    $(".SearchItemBox").remove();
                    
                    $(".LoadingFeed").css("display", "flex");
                    $(".FilterItem").removeClass("active");
                    $("#btnAllFilter").addClass("active");
                    
                    $("#AllItensFrame").css("display", "block");
                    $("#CategoryItensFrame").css("display", "None");

                }

            }).done(function(){   

                AJAXRequestStatus(1);  
                
                $(".LoadingFeed").css("display", "none");     

                $(FeedAll).load(folder);
        
                
            }).fail(function(){

                AJAXRequestStatus(0);

            });
            
        });

});