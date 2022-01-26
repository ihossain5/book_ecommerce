$(document).ready(function() {
    $('.banner_slider .owl-carousel').owlCarousel({
        autoplay: true,
        loop: true,
        margin: 10,
        dots: true,
        nav: false,
        autoplayTimeout: 5000,
        autoplaySpeed: 800,
        responsive:{
            0:{
                items:1
            },
        }
    })
})