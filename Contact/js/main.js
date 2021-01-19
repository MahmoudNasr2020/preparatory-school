/*global $*/
var text=true,
    name=true,
    email=true;
    $('.name').on('blur',function(){
        "use strict";
        if($(this).val().length<3){
            $('.alert-error1').fadeIn(100);
            name=true;

        }else{
            $('.alert-error1').fadeOut();
            name=false;
        }
    });
$('.email').on('blur',function(){
        "use strict";
        if($(this).val().length<5){
            $('.alert-error2').fadeIn(100);
            email=true;

        }else{
            $('.alert-error2').fadeOut();
            email=false;
        }
    });
    $('.mess').on('blur',function(){
        "use strict";
        if($(this).val().length<5){
            $('.alert-error3').fadeIn(100);
            text=true;

        }else{
            $('.alert-error3').fadeOut();
            text=false;
        }
    });
    $("form").submit(function(e){
        "use strict";
        if(text==true||name==true||email==true) {
            e.preventDefault();

        }

    });
