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

    const ItemBox = $(".ItemBox");

    var FeedAll = $("#FeedAll");
    var FeedCategory = $("#FeedCategory");

    var FeedAllDisplay = $("#AllItensFrame").css("display");
    var FeedCategoryDisplay = $("#CategoryItensFrame").css("display");

    /* Filtes */

        // A-Z
        $("#btnFeedAZ").on("click", function(){

            // All
            if(FeedAllDisplay == "block"){

                var folder = "php/Filters/All/FilterAZ.php";

                FilterCategory.removeClass("active");
                $("#btnAllFilter").addClass("active");

                $.ajax({
                    
                    url : folder,
                    type : 'get',

                    beforeSend : function(){
                        
                        $(".ItemBox").remove();
                        
                        $(".LoadingFeed").css("display", "flex");

                    }

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(".LoadingFeed").css("display", "none");    

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

                FilterCategory.removeClass("active");
                $("#btnAllFilter").addClass("active");

                $.ajax({
                    
                    url : folder,
                    type : 'get',

                    beforeSend : function(){
                        
                        $(".ItemBox").remove();
                        
                        $(".LoadingFeed").css("display", "flex");

                    }

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(".LoadingFeed").css("display", "none");    

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

                FilterCategory.removeClass("active");
                $("#btnAllFilter").addClass("active");

                $.ajax({
                    
                    url : folder,
                    type : 'get',

                    beforeSend : function(){
                        
                        $(".ItemBox").remove();
                        
                        $(".LoadingFeed").css("display", "flex");

                    }

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(".LoadingFeed").css("display", "none");    

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

                FilterCategory.removeClass("active");
                $("#btnAllFilter").addClass("active");

                $.ajax({
                    
                    url : folder,
                    type : 'get',

                    beforeSend : function(){
                        
                        $(".ItemBox").remove();
                        
                        $(".LoadingFeed").css("display", "flex");

                    }

                }).done(function(){
    
                    AJAXRequestStatus(1);

                    $(".LoadingFeed").css("display", "none");    

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

        
    /*******************************************************
        Feed Config
    *******************************************************/

    var folder;

    function setFolder(type){

        return `php/Config.php?q=${type}`;

    }

    $("#PromoteUserAccess").on("click", function(){

        folder = setFolder(1);

        alert(folder);

    });

    $("#PromoteUserAccess").on("click", function(){

        folder = setFolder(2);

        alert(folder);

    });

    $("#DenyUserAccess").on("click", function(){

        folder = setFolder(3);

        alert(folder);

    });

    $("#RemoveUserAccess").on("click", function(){

        folder = setFolder(4);

        alert(folder);

    });

});