function socialicons_imFooter_pluginAppObj_14() {
    
    var containerWidth;
    var btnWidth;
    var btnHeight;
    var btnMargin;
    var numBtn; 
    
    x5engine.boot.push(function(){
        
        btnWidth = 50;
        btnHeight = 50;
        btnMargin = 30;
        numBtn = $("#imFooter_pluginAppObj_14 .social-icon").length;
        
        $('#imContent').on('breakpointChangedOrFluid', function (e, breakpoint) {
            resizeSocials_imFooter_pluginAppObj_14();
        });
        resizeSocials_imFooter_pluginAppObj_14();
    });

       function resizeSocials_imFooter_pluginAppObj_14() {
           
           /*reset margins*/
           $("#imFooter_pluginAppObj_14 .social-icon").removeClass("last-item-row");
           $("#imFooter_pluginAppObj_14 .social-icon").removeClass("last-row");
           $("#imFooter_pluginAppObj_14 .social-icon").removeClass("one-row");
                 
           containerWidth = $('#imFooter_pluginAppObj_14').width();
           
           var buttonPerRow = 1;
           if("horizontal" === "horizontal")
                buttonPerRow = getButtonPerRow();
               
           if(buttonPerRow == 1){
               $("#imFooter_pluginAppObj_14 .social-icon:last-child").addClass("last-row");
           }
           else if(numBtn == buttonPerRow){
               $("#imFooter_pluginAppObj_14 .social-icon").addClass("last-row");
               $("#imFooter_pluginAppObj_14 .social-icon:last-child").addClass("last-item-row");  
            }
           else{
               $("#imFooter_pluginAppObj_14 .social-icon:nth-child(" + buttonPerRow + "n)").addClass("last-item-row");
               $("#imFooter_pluginAppObj_14 .social-icon:nth-child(n+" + parseInt(buttonPerRow+1) + ")").addClass("last-row");
           }
             
           var fact = containerWidth < btnWidth ? containerWidth / btnWidth : 1;
           $('#imFooter_pluginAppObj_14 .social-icon, #imFooter_pluginAppObj_14 .sides-container').css({
               width: btnWidth * fact,
               height: btnHeight * fact
           });
       }

        function getButtonPerRow() {
            var remaining = containerWidth - btnWidth;
            var count = 1;
            while (remaining >= btnWidth + (count == numBtn-1 ? 0 : btnMargin)) {
                count++;
                if(count == numBtn)
                    break;
                
                remaining -= btnWidth + btnMargin;
            }           
            return count;
        }
}