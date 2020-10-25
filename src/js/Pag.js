/*******************************************************
	
	JS - Página - V1

--------------------------------------------------------

	Todos os direitos reservados.
	Desenvolvido por APE Group. 
																					
*******************************************************/


/*******************************************************
    Validations
*******************************************************/

    /*******************************************************
        User Loged
    *******************************************************/
   
   $(document).ready(function(){

        $("#EndUserSession").on("click", function(){

            window.open("php/EndUserSession.php", "_self");

        });

   });   

/*******************************************************
    Switch Theme
*******************************************************/

$(document).ready(function(){ 

    const DMS = $(".DarkModeSwitch");
    const LMS = $(".LightModeSwitch");

    var Theme = localStorage.getItem("Theme");

    if(Theme != null){
;
        $("body").addClass(Theme);
    
    }
    
    if(Theme == "LightMode"){

        $("body").removeClass("DarkMode").addClass("LightMode");
        
        DMS.css("display", "block");
        LMS.css("display", "none");
    
    }else{
    
        if(Theme == "DarkMode"){

            $("body").removeClass("LightMode").addClass("DarkMode");
            
            DMS.css("display", "none");
            LMS.css("display", "block");
    
        }else{
    
            if(Theme == null){
    
                DMS.css("display", "block");
                LMS.css("display", "none");
    
            }
    
        }
    
    }

    // Icon

    DMS.on("click", function(){

        $("body").removeClass("LightMode").addClass("DarkMode");
        localStorage.setItem("Theme", "DarkMode");

        DMS.css("display", "none");
        LMS.css("display", "block");

    });

    LMS.on("click", function(){

        $("body").removeClass("DarkMode").addClass("LightMode");
        localStorage.setItem("Theme", "LightMode");

        DMS.css("display", "block");
        LMS.css("display", "none");

    });

});

/*******************************************************
    Click
*******************************************************/

$(document).ready(function(){

    const HN = $("#HeaderNotification");
    const HC = $("#HeaderConfig");
    const SNB = $("#SideNavBar");
    const DBCP = $("#DashboardControlPane");
    const FCP = $("#FeedControlPane");
    const DE = $("#DarkEffect");

    /* Hide element clicking outside element */  
    $(document).mouseup(function(e){

        // HeaderNotification
        if(!HN.is(e.target) && HN.has(e.target).length === 0){

            HN.css("display", "none");

        }
        
        // HeaderConfig
        if(!HC.is(e.target) && HC.has(e.target).length === 0){

            HC.css("display", "none");

        }

        // Dashboard Control Pane
        if(!DBCP.is(e.target) && DBCP.has(e.target).length === 0){

            DBCP.css("display", "none");

        }

        // Feed Control Pane
        if(!FCP.is(e.target) && FCP.has(e.target).length === 0){

            FCP.css("display", "none");

        }

    });

    /* Dark Effect */

    DE.on("click", function(){
        // OFF
        SNB.css("left", "-300px");
        HN.css("display", "none");
        HC.css("display", "none");
        DBCP.css("display", "none");
        FCP.css("display", "none");
        DE.css({"opacity": "0", "visibility": "hidden"});

    });

    /* Discover Overlay */

        /* Divs */
        const D1 = $("#D1");
        const D2 = $("#D2");
        const D3 = $("#D3");
        const D4 = $("#D4");

        /* Content */
        const DC1 = $("#DiscoverContent1");
        const DC2 = $("#DiscoverContent2");
        const DC3 = $("#DiscoverContent3");
        const DC4 = $("#DiscoverContent4");

        const DO = $("#DiscoverOverlay");
        const DOUL = $(".DiscoverOverlayUL");

        /* Close */

        $("#CloseDiscoverOverlay").on("click", function(){
            /* OFF */
            DO.css({"opacity": "0", "visibility": "hidden"});

        });

        DO.on("click", function(){

            DO.css({"opacity": "0", "visibility": "hidden"});

        });

        /* Divs */

        D1.on("click", function(){
            /* OF */
            DOUL.css("display", "none");
            /* ON */
            DO.css({"opacity": "1", "visibility": "visible"});
            DC1.css("display", "grid");

        });

        D2.on("click", function(){
            /* OF */
            DOUL.css("display", "none");
            /* ON */
            DO.css({"opacity": "1", "visibility": "visible"});
            DC2.css("display", "grid");

        });

        D3.on("click", function(){
            /* OF */
            DOUL.css("display", "none");
            /* ON */
            DO.css({"opacity": "1", "visibility": "visible"});
            DC3.css("display", "grid");

        });

        D4.on("click", function(){
            /* OF */
            DOUL.css("display", "none");
            /* ON */
            DO.css({"opacity": "1", "visibility": "visible"});
            DC4.css("display", "grid");

        });

    /* Side NavBar */

    $("#HeaderNavIcon").on("click", function(){   
        
        var SNB_Left = SNB.css("left");
        
        if(SNB_Left == "-300px"){
            // ON
            SNB.css("left", "0");
            DE.css({"opacity": "1", "visibility": "visible"});     
            // OFF
            HN.css("display", "none");
            HC.css("display", "none"); 
            DBCP.css("display", "none");  
            FCP.css("display", "none"); 

        }else{
            // OFF
            SNB.css("left", "-300px");
            DE.css({"opacity": "0", "visibility": "hidden"});   
            HN.css("display", "none");      
            HC.css("display", "none");
            DBCP.css("display", "none");
            FCP.css("display", "none");

        }   

    });

    /* Header Notification */

    $("#HeaderNotificationIcon").on("click", function(){

        var HN_display = HN.css("display");

        if(HN_display == "none"){
            // ON
            HN.css("display", "block");  
            // OFF
            HC.css("display", "none");
            SNB.css("left", "-300px");
            DE.css({"opacity": "0", "visibility": "hidden"});
            BDCP.css("display", "none");
            FCP.css("display", "none");
           
        }else{
            // OFF
            HC.css("display", "none");
            SNB.css("left", "-300px");        
            DE.css({"opacity": "0", "visibility": "hidden"});
            DBCP.css("display", "none");
            FCP.css("display", "none");
           
        }    

    });

    /* Header Config */

    $("#HeaderUserIcon").on("click", function(){

        var HC_display = HC.css("display");

        if(HC_display == "none"){
            // ON
            HC.css("display", "block");  
            // OFF
            HN.css("display", "none");
            SNB.css("left", "-300px");
            DE.css({"opacity": "0", "visibility": "hidden"});
            DBCP.css("display", "none");
            FCP.css("display", "none");
           
        }else{
            // OFF
            HN.css("display", "none");
            HC.css("display", "none");
            SNB.css("left", "-300px");        
            DE.css({"opacity": "0", "visibility": "hidden"});
            DBCP.css("display", "none");
            FCP.css("display", "none");
           
        }    

    });

    /* Dashboard Control Pane */

    $("#btnDashboardControl").on("click", function(){
        // ON
        DBCP.css("display", "block");
        // OFF
        HN.css("display", "none");
        HC.css("display", "none");
        SNB.css("left", "-300px");        

    });

    /* Feed Control Pane */

    $("#btnFeedControl").on("click", function(){
        // ON
        FCP.css("display", "block");
        // OFF
        HN.css("display", "none");
        HC.css("display", "none");
        SNB.css("left", "-300px");        

    });

});

/*******************************************************
    Header
*******************************************************/

$(document).ready(function(){

    /* Sticky */
	  
    "use strict";
    
    var c, currentScrollTop = 0, navbar = $("header");

    $(window).scroll(function(){

        var a = $(window).scrollTop();
        var b = navbar.height();
       
        currentScrollTop = a;
       
        if(c < currentScrollTop && a > b){
            // ON
            navbar.addClass("scrollUp");    
            // OFF
            $("#HeaderNotification").css("display", "none");
            $("#HeaderConfig").css("display", "none");
            $(".ControlPane").css("display", "none");
            $("#Clear").css({"opacity": "0", "visibility": "hidden"});
            $("#DiscoverOverlay").css({"opacity": "0", "visibility": "hidden"});
            $(".DiscoverOverlayUL").css("display", "none");

        }else if(c > currentScrollTop ){
            // OFF
            navbar.removeClass("scrollUp");
            $(".ControlPane").css("display", "none");

        }

        c = currentScrollTop;

    });

    /* Notifications */

    $("#ClearNotifications").on("click", function(){
        // ON
        $("#NotificationNone").css("display", "block");
        $("#NoneNotifications").css("display", "block"); 
        // OFF
        $("#NotificationAlert").css("display", "none");
        $(".NotificationBox").css("display", "none");
        $("#NotificationsConfig").css("display", "none");

    });

    if($(".NotificationBox").length > 0){
        // ON
        $("#NotificationAlert").css("display", "block");
        // OFF
        $("#NotificationNone").css("display", "none");
    
    }else {
        // ON
        $("#NotificationNone").css("display", "block");
        $("#NoneNotifications").css("display", "block");
        // OFF
        $("#NotificationAlert").css("display", "none");
        $("#NotificationsConfig").css("display", "none");
        
    }
    
});

/*******************************************************
    Main
*******************************************************/

/* User Nav Config */

$(document).ready(function(){

    const UCO = $(".UserConfigOption");

    UCO.on("click", function(){

        UCO.removeClass("active");
        $(this).addClass("active");

    });

});

/* Frame View */

$(document).ready(function(){

    const UCV = $("#UserCompaniesView");

    const VBS = $("#NavUserViewBoxSwitch");
    const VLS = $("#NavUserViewListSwitch");

    var LS_UCV = localStorage.getItem("UCV");

    if(LS_UCV != null){

        UCV.removeAttr("class");
        UCV.addClass(LS_UCV);
    
    }
    
    if(LS_UCV == "BoxView"){

       VLS.css("display", "block");
       VBS.css("display", "none");
    
    }else{

        if(LS_UCV == "ListView"){
        
            VLS.css("display", "none");
            VBS.css("display", "block");
    
        }else{

            if(LS_UCV == null){

                VLS.css("display", "block");
                VBS.css("display", "none");

            }

        }

    }

    VBS.on("click", function(){

        UCV.removeClass("ListView").addClass("BoxView");
        
        localStorage.setItem("UCV", "BoxView");

        VLS.css("display", "block");
        VBS.css("display", "none");

    });

    VLS.on("click", function(){

        UCV.removeClass("BoxView").addClass("ListView");

        localStorage.setItem("UCV", "ListView");

        VLS.css("display", "none");
        VBS.css("display", "block");

    });

});

/* Frames */

$(document).ready(function(){

    const NUF = $(".NavUserFrame");

    // 1
    $("#UFO1").on("click", function(){

        NUF.css("display", "none");

        $("#UF1").css("display", "block");

    });

    // 2
    $("#UFO2").on("click", function(){

        NUF.css("display", "none");

        $("#UF2").css("display", "block");

    });

    // 3
    $("#UFO3").on("click", function(){

        NUF.css("display", "none");

        $("#UF3").css("display", "block");

    });

    // 4
    $("#UFO4").on("click", function(){

        NUF.css("display", "none");

        $("#UF4").css("display", "block");

    });

});

/* Quick Access Bar */

$(document).ready(function(){

    if($(".CompanyBox").length > 0){

        $("#CompaniesQuickAccessBar").css("display", "grid");

    }else{

        $("#CompaniesQuickAccessBar").css("display", "none");

    }

});

/* PWD View */

$(document).ready(function(){

    $("#DataPlaceholderPWD").on("click", function(){

        $(this).css("display", "none");
        $("#DataPWD").css("display", "block");

    });

});

/* Fedd */

$(document).ready(function(){

    const FilterCategory = $(".FilterCategory");
    const FilterParamenter = $(".FilterParameter");
    const FeedFrame = $(".FeedFrame");

    /* Icons */

        // Category
        FilterCategory.on("click", function(){

            FilterCategory.removeClass("active");
            $(this).addClass("active");
    
        });

        // Parameter
        FilterParamenter.on("click", function(){

            FilterParamenter.removeClass("active");
            $(this).addClass("active");
    
        });
    
    /* Frames */

        // ALL
        $("#btnAllFilter").on("click", function(){

            FeedFrame.css("display", "none");
            $("#AllItensFrame").css("display", "block");

        });

        // Category
        $("#btnCategoryFilter").on("click", function(){

            FeedFrame.css("display", "none");
            $("#CategoryItensFrame").css("display", "block");

        });

});

/* Bottom Message */

$(document).ready(function(){
    
    $(".ExitMessageBottom").on("click", function(){

        $(".BottomMessage").css("bottom", "-75px");

    });
    
});

/*******************************************************
    Generate Message
*******************************************************/

$(document).ready(function(){

    function GenerateMessage(CodV, CodText){

        // Error
        if(CodV == "0"){

            switch(CodText){

                case 1:

                    alert("Erro ao copiar texto para a área de transferência");
                    
                break;

            }
            
        }

        // True
        if(CodV == "1"){

            switch(CodText){

                // Copy to Clipboard
                case 1:

                    alert("Texto copiado para a área de transferência");
                    
                break;

            }

        }

    }

});