// Sticky header
// $(window).scroll(function() {
//     if ($(window).scrollTop() > 0) {
//         $("header").addClass("sticky");
//     } else {
//         $("header").removeClass("sticky");
//     }
// });

const sliderImage = slider => {
    console.log(slider);
    // let image = "";
    // if (window.innerWidth > 1601) {
    //     image = slider.desktop;
    // } else if (window.innerWidth > 1200 && window.innerWidth <= 1600) {
    //     image = slider.laptop;
    // } else {
    //     image = slider.mobile;
    // }
    // return image;
};

// Jquery
$(document).ready(function() {
    let headerOffset = $("#primaryMenu").offset();
    let primaryMenu = $("#primaryMenu");
    let headerDiv = $("#headerDiv");
    let headerHeight = primaryMenu.height();
    headerDiv.css({ height: headerHeight + "px" });


    
    if ($(window).scrollTop() > headerOffset.top) {
        primaryMenu.addClass("sticky");
        primaryMenu.addClass("fixed-top");
        headerDiv.removeClass("d-none");
    }

    $(window).on("scroll", function() {
        if ($(this).scrollTop() > headerOffset.top) {
            primaryMenu.addClass("sticky");
            primaryMenu.addClass("fixed-top");
            headerDiv.removeClass("d-none");
        } else {
            primaryMenu.removeClass("sticky");
            primaryMenu.removeClass("fixed-top");
            headerDiv.addClass("d-none");
        }
    });

    // $(".post").each(function(index) {
    //     var self = $(this);
    //     setTimeout(function() {
    //         self.addClass("post-anime");
    //     }, index * 400);
    // });
    new WOW().init();
    // Home page slider
    $(".sliders").slick({
        autoplay: false,
        arrows: true,
    });

    $("#toggleMenu").on("click", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(".menu-list").addClass("toggleMenu");
    });
    $(document.body).click(function() {
        $(".menu-list").removeClass("toggleMenu");
    });

    // $(".main-slider").owlCarousel({
    //     loop: true,
    //     margin: 10,
    //     nav: true,
    //     autoplay: true,
    //     autoplayTimeout: 3000,
    //     autoplaySpeed: 1000,
    //     navText: [
    //         "<i class='fas fa-chevron-left'></i>",
    //         "<i class='fas fa-chevron-right'></i>"
    //     ],
    //     dots: false,
    //     responsive: {
    //         0: {
    //             items: 1
    //         },
    //         600: {
    //             items: 1
    //         },
    //         1000: {
    //             items: 1
    //         }
    //     }
    // });

    $("a.about-company-video").YouTubePopUp();
});

$(document).on("click", ".share-icon .facebook", function(e) {
    // e.preventDefault();
    let title = $(this).attr("data-title");
    let image = $(this).attr("data-image");
    let url = $(this).attr("data-url");
    $("meta[property='og\\:title']").attr("content", title);
    $("meta[property='og\\:url']").attr("content", url);
    $("meta[property='og\\:image']").attr("content", image);
});

$(document).on("click", ".share-icon .twitter", function(e) {
    // e.preventDefault();
    let title = $(this).attr("data-title");
    let image = $(this).attr("data-image");
    let url = $(this).attr("data-url");
    $("meta[property='og\\:title']").attr("content", title);
    $("meta[property='og\\:url']").attr("content", url);
    $("meta[property='og\\:image']").attr("content", image);
});

function equalHeight(className) {
    var selector = $(className);
    var heights = [];

    selector.each(function() {
        var height = $(this).height();
        heights.push(height);
    });

    var maxHeight = Math.max.apply(null, heights);
    selector.each(function() {
        $(this).height(maxHeight);
    });
}
