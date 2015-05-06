$(document).ready(function() {
    
    //fadein main letters   
    
    
    var $window = $(window);
    
    function portraitPosition() {
        
        var $winWidth = 1920;               
        var $boothHeight = $(".photoBooth").height();
        var $domConWidth = $("#dominicPhoto").width();
        var $nameConWid = $winWidth*0.12;
        
        var $domNameMarLeftAdj = ($domConWidth-$nameConWid)*0.65;
//        space between portait and letters
        var $nameMarTop = (($boothHeight*0.56)- $nameConWid)*0.5;       
//        console.log($nameMarTop);               
//        console.log($nameConWid);
        
        $(".nameContain").css({"margin-top":$nameMarTop,"width":$nameConWid,"height":$nameConWid});
//        $("#domNameContain").css("margin-left",$domNameMarLeftAdj);
//        console.log($domNameMarLeftAdj);
        
        $(".longNamesContain").css({"height":$nameConWid, "margin-top":$nameMarTop});
        var $daddyWidth = $(".longNamesContain").width();
        console.log($daddyWidth);
        
        $(".names, #letterS, #letterAnd").fadeIn("2000");
    };
    
    portraitPosition();
    
    $nameHeight = $("#ianPhoto .names").height();
    
    function sizeCheck(){
        var deferred = $.Deferred();
        
        var checkInterval = setInterval(function(){
            if($("#ianPhoto .names").height() == $nameHeight){
                clearInterval(checkInterval);
                deferred.resolve();
                console.log($("#ianPhoto .names").height());
            }

        },"100");
        
        $("#ianPhoto .nameContain").mouseleave(function(){
            deferred.reject();  
        });
        
        return deferred.promise();
    };
    
    $("#ianPhoto .nameContain").mouseenter(function(e){
        e.preventDefault();
        if($(this).height()!=$nameHeight){
            sizeCheck().done(function(){
//                aniShowName($(this));
                console.log("waited to act");
                showDetails();
            });
            sizeCheck().fail(function(){
                console.log("deffered interrupcted");
                return;
            });
        }
        else{
          showDetails();  
        };
    });
    
//    function aniShowName($el){
//        $el.animate({
//                height:'50%',
//                width:'50%'
//            }, 1000);
//    };
    
    $("#ianPhoto .nameContain").mouseleave(function(){
        hideDetails();
    });
    
    
    
    
    
    function showDetails() {
         $("#ianPhoto .names").stop(true, false).animate({
            height:'50%',
            width:'50%'
            }, 500);

         $("#ianPhoto .fullnameContain").stop(true, false).delay("500").fadeIn("500");

         $("#ianPhoto .akaContain").stop(true, false).delay("500").fadeIn("500");

         $("#ianPhoto .theContain, #ianPhoto .nicknameContain").stop(true, false).delay("1000").fadeIn("500");         
    };
    
    function hideDetails() {
        $("#ianPhoto .fullnameContain, #ianPhoto .akaContain, #ianPhoto .theContain, #ianPhoto .nicknameContain").stop(true, false).fadeOut("100");
        
        $("#ianPhoto .names").delay("200").animate({
            height:'100%',
            width:'100%'
        }, 500);        
    };
//    
//    $("#ianNameContain").mouseover(function(){
//        
//        
//        
//        showDetails();
//            
//        
//        
//    });
//
//    
//    $("#ianNameContain").mouseleave(function(){
//
//        hideDetails();
//        
//    });
    
//    $("#ianPhoto .nicknameContain").fadeIn("slow");
    
    
});