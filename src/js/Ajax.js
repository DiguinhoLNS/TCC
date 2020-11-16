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

    var FeedAll = $(".FeedAll");
    var FeedCategory = $(".FeedCategory");
    var FeedSearch = $(".FeedSearch");

    function FeedGenerate(t,p){

        var folder, FeedType;

        switch(t){

            // All
            case 1:

                FeedType = FeedAll;
                
                switch(p){

                    case 1:
                        
                        folder = "php/Filters/All/FilterAZ.php";
                    
                    break;

                    case 2:
                        
                        folder = "php/Filters/All/FilterZA.php";
                    
                    break;

                    case 3:
                        
                        folder = "php/Filters/All/FilterRecente.php";
                    
                    break;

                    case 4:
                        
                        folder = "php/Filters/All/FilterAntigo.php";
                    
                    break;

                }
            
            break;

            // Category
            case 2:

                FeedType = FeedCategory;
                
                switch(p){

                    case 1:
                        
                        folder = "php/Filters/Category/Acessorios.php";
                    
                    break;

                    case 2:
                        
                        folder = "php/Filters/Category/Documentos.php";
                    
                    break;

                    case 3:
                        
                        folder = "php/Filters/Category/Eletronicos.php";
                    
                    break;

                    case 4:
                        
                        folder = "php/Filters/Category/Roupas.php";
                    
                    break;

                    case 5:
                        
                        folder = "php/Filters/Category/Outros.php";
                    
                    break;

                }
            
            break;

        }

        $.ajax({
                    
            url : folder,
            type : 'get',

            beforeSend : function(){

                if(t == "1"){

                    $(".AllItemBox").remove();

                }else if(t == "2"){

                    $(".CategoryItemBox").remove();

                }else if(t == "3"){

                    $(".SearchItemBox").remove();

                }   

                $(".LoadingFeed").css("display", "flex");

            }

        }).done(function(){

            AJAXRequestStatus(1); 

            $(".LoadingFeed").css("display", "none");

            $(FeedType).load(folder);

        }).fail(function(){

            AJAXRequestStatus(0);

        });

    }

    /* All */

        // AZ
        $("#FilterAll1").on("click", function(){

            FeedGenerate(1,1);

        });

        // ZA
        $("#FilterAll2").on("click", function(){

            FeedGenerate(1,2);

        });

        // Recente
        $("#FilterAll3").on("click", function(){

            FeedGenerate(1,3);

        });

        // Antigo
        $("#FilterAll4").on("click", function(){

            FeedGenerate(1,4);

        });

    /* Category */

        $("#FilterCategory1").on("click", function(){

            FeedGenerate(2,1);

        });

        $("#FilterCategory2").on("click", function(){

            FeedGenerate(2,2);

        });

        $("#FilterCategory3").on("click", function(){

            FeedGenerate(2,3);

        });
        $("#FilterCategory4").on("click", function(){

            FeedGenerate(2,4);

        });

    /* Search Bar */

    $("#btnSearchFeed").on("click", function(){

        var pesquisa = $("#FeedSearchItens").val();

        var folder = `php/Filters/Search.php?q=${pesquisa}`;

        $.ajax({

            url : folder,
            type : 'get',

            beforeSend : function(){
                
                $(".SearchItemBox").remove();
                $(".LoadingFeed").css("display", "flex");

            }

        }).done(function(){   

            AJAXRequestStatus(1);  
            
            $(".LoadingFeed").css("display", "none");     

            $(FeedSearch).load(folder);
            
        }).fail(function(){

            AJAXRequestStatus(0);

        });
        
    });

});