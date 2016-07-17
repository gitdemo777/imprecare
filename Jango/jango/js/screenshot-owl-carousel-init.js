function owlCarouselInit(){
	var owl3D = $('#screenshot-slide .curosel');

owl3D.on('initialized.owl.carousel', function(e){
var idx = e.item.index;
$('#screenshot-slide .owl-item').eq(idx).addClass('big');
$('#screenshot-slide .owl-item').eq(idx-1).addClass('left bi');
$('#screenshot-slide .owl-item').eq(idx+1).addClass('right bi');
$('#screenshot-slide .owl-item').eq(idx-2).addClass('left sm');
$('#screenshot-slide .owl-item').eq(idx+2).addClass('right sm');
});

owl3D.owlCarousel({
center: true,
items:5,
loop:true,
nav: true,
dots:false,
autoplay:false,
navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
responsiveClass:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});

owl3D.on('translate.owl.carousel', function(e){
var idx = e.item.index;
$('#screenshot-slide .owl-item.big').removeClass('big');
$('#screenshot-slide .owl-item.right.bi').removeClass('right bi');
$('#screenshot-slide .owl-item.right.sm').removeClass('right sm');
$('#screenshot-slide .owl-item.right').removeClass('right');
$('#screenshot-slide .owl-item.left.bi').removeClass('left bi');
$('#screenshot-slide .owl-item.left.sm').removeClass('left sm');
$('#screenshot-slide .owl-item.left').removeClass('left');
$('#screenshot-slide .owl-item').eq(idx).addClass('big');
$('#screenshot-slide .owl-item').eq(idx-1).addClass('left bi');
$('#screenshot-slide .owl-item').eq(idx+1).addClass('right bi');
$('#screenshot-slide .owl-item').eq(idx-2).addClass('left sm');
$('#screenshot-slide .owl-item').eq(idx+2).addClass('right sm');
});
	
}