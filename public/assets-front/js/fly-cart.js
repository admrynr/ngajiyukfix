$('.cart-info button').on('click', function () {
    
    var name = $(this).attr('data-name');
    var price = $(this).attr('data-price');
    var image = $(this).attr('data-image');
    var base_url = window.location.origin;
    $(".cart-holder").append( "<li>"
        +'<div class="media">'
            +'<a href="#"><img alt="" class="mr-3" src="'+base_url+'/images/'+image+'"></a>'
            +'<div class="media-body">'
                +'<a href="#">'
                    +"<h4>"+name+"</h4>"
                +"</a>"
                +"<h4><span>1 x Rp"+price+"</span></h4>"
            +"</div>"
        +"</div>"
        +'<div class="close-circle"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div>'
        +"</li>");
    sessionStorage.setItem('cartSess, .cart-holder');    

    if($(window).width() > 576){
        var cart = $('.addcart_btm_popup');
    }else{
        var cart = $('.mobile-cart .icon-shopping-cart');
    }
    var imgtodrag = $(this).parents('.product-box').find(".front .bg-size, .front img").eq(0);
    if (imgtodrag) {
        var imgclone = imgtodrag.clone()
            .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
            .css({
                'opacity': '0.5',
                'position': 'absolute',
                'height': '150px',
                'width': '150px',
                'z-index': '100'
            })
            .appendTo($('body'))
            .animate({
                'top': cart.offset().top + 10,
                'left': cart.offset().left + 10,
                'width': 75,
                'height': 75
            }, 1000, 'easeInOutExpo');

        setTimeout(function () {
            cart.effect("shake", {
                times: 2
            }, 200);
        }, 1500);

        imgclone.animate({
            'width': 0,
            'height': 0
        }, function () {
            $(this).detach()
        });
    }
});