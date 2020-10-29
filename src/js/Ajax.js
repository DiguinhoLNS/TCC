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

                var folder = "php/Filters/All/FilterAZ.php";

                $.ajax(folder,{

                }).done(function(){

                    AJAXRequestStatus(1);

                    AllItemBox.remove();

                    $(FeedAll).load(folder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

            // Category
            if(FeedCategoryDisplay == "block"){

                var folder = "php/Filters/Category/FilterAZ.php";

                $.ajax(folder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(FeedCategory).load(folder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

        });

        // Z-A
        $("#btnFeedZA").on("click", function(){

            // All
            if(FeedAllDisplay == "block"){

                var folder = "php/Filters/All/FilterZA.php";

                $.ajax(folder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    AllItemBox.remove();

                    $(FeedAll).load(folder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

            // Category
            if(FeedCategoryDisplay == "block"){

                var folder = "php/Filters/Category/FilterZA.php";

                $.ajax(folder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(FeedCategory).load(folder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

        });

        // Recente
        $("#btnFeedRecente").on("click", function(){

            // All
            if(FeedAllDisplay == "block"){

                var folder = "php/Filters/All/FilterRecente.php";

                $.ajax(folder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    AllItemBox.remove();

                    $(FeedAll).load(folder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

            // Category
            if(FeedCategoryDisplay == "block"){

                var folder = "php/Filters/Category/FilterRecente.php";

                $.ajax(folder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(FeedCategory).load(folder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

        });

        // Antigo
        $("#btnFeedAntigo").on("click", function(){

            // All
            if(FeedAllDisplay == "block"){

                var folder = "php/Filters/All/FilterAntigo.php";

                $.ajax(folder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    AllItemBox.remove();

                    $(FeedAll).load(folder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

            // Category
            if(FeedCategoryDisplay == "block"){

                var folder = "php/Filters/Category/FilterAntigo.php";

                $.ajax(folder,{

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(FeedCategory).load(folder);
    
                }).fail(function(){
    
                    AJAXRequestStatus(0);
    
                });

            }

        });

        /* Search Bar */

        var FeedSearchBar = $("#FeedSearchItens");

        FeedSearchBar.keyup(function(){

            var pesquisa = FeedSearchBar.val();
      
            var folder = `php/Filters/Search.php?q=${pesquisa}`;

            $.ajax(folder,function(){   

            }).done(function(){   

                AJAXRequestStatus(1);

                AllItemBox.remove();

                $(".FilterItem").removeClass("active");
                $("#btnAllFilter").addClass("active");
                
                $("#AllItensFrame").css("display", "block");
                $("#CategoryItensFrame").css("display", "None");

                $(FeedAll).load(folder);
                
            }).fail(function(){

                AJAXRequestStatus(0);

            });

            
        });

});