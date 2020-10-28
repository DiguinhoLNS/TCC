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

    /*******************************************************
        Feed
    *******************************************************/

    const AllFolder = "php/Filters/All/FilterAZ.php";
    const CategoryFolder = "php/Filters/Category/FilterRecente.php";
    const AllItemBox = $(".AllItemBox");
    const CategoryItemBox = $(".CategoryItemBox");
    const FeedAll = $("#FeedAll");
    const FeedCategory = $("#FeedCategory");

    var FeedAllDisplay = $("#AllItensFrame").css("display");
    var FeedCategoryDisplay = $("#CategoryItensFrame").css("display");

    /* Filtes */

        // A-Z
        $("#btnFeedAZ").on("click", function(){

            // All
            if(FeedAllDisplay == "block"){

                $.ajax(AllFolder,{

                }).done(function(){

                    AJAXRequestStatus(1);

                    AllItemBox.remove();

                    $(FeedAll).load(AllFolder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

            // Category
            if(FeedCategoryDisplay == "block"){

                $.ajax(CategoryFolder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(FeedCategory).load(CategoryFolder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

        });

        // Z-A
        $("#btnFeedZA").on("click", function(){

            // All
            if(FeedAllDisplay == "block"){

                $.ajax(AllFolder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    AllItemBox.remove();

                    $(FeedAll).load(AllFolder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

            // Category
            if(FeedCategoryDisplay == "block"){

                $.ajax(CategoryFolder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(FeedCategory).load(CategoryFolder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

        });

        // Recente
        $("#btnFeedRecente").on("click", function(){

            // All
            if(FeedAllDisplay == "block"){

                $.ajax(AllFolder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    AllItemBox.remove();

                    $(FeedAll).load(AllFolder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

            // Category
            if(FeedCategoryDisplay == "block"){

                $.ajax(CategoryFolder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(FeedCategory).load(CategoryFolder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

        });

        // Antigo
        $("#btnFeedAntigo").on("click", function(){

            // All
            if(FeedAllDisplay == "block"){

                $.ajax(AllFolder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    AllItemBox.remove();

                    $(FeedAll).load(AllFolder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

            // Category
            if(FeedCategoryDisplay == "block"){

                $.ajax(CategoryFolder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(FeedCategory).load(CategoryFolder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

        });

        /* Search Bar */

        $("#FeedSearchItens").keyup(function(){

            AllItemBox.remove();

            $(".FilterCategory").removeClass("active");

            $("#AllItensFrame").css("display", "block");
            $("#CategoryItensFrame").css("display", "None");
            
        });

});