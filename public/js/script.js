//Появление\изчезание бургера
window.addEventListener('DOMContentLoaded', () => {
    const menu = document.querySelector('.menu'),
    menuItem = document.querySelectorAll('.menu_item'),
    hamburger = document.querySelector('.hamburger');

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('hamburger_active');
        menu.classList.toggle('menu_active');
    });

    menuItem.forEach(item => {
        item.addEventListener('click', () => {
            hamburger.classList.toggle('hamburger_active');
            menu.classList.toggle('menu_active');
        })
    })
})


$(document).ready(function(){
    $('.carousel_inner_styles').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 4,
        prevArrow: '<button type="button" class="slick-prev"><img src="icons/arrows/arrow-left.png"></button>',
        nextArrow: '<button type="button" class="slick-next"><img src="icons/arrows/arrow-right.png"></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
              },
              {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },]
    });
    $('.carousel_inner_countries').slick({
        infinite: false,
        slidesToShow: 6,
        slidesToScroll: 6,
        prevArrow: '<button type="button" class="slick-prev"><img src="icons/arrows/arrow-left.png"></button>',
        nextArrow: '<button type="button" class="slick-next"><img src="icons/arrows/arrow-right.png"></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },]
    });


    //появление\исчезание модального окна
    $('[data-modal=subscribe]').on('click', function() {
        $('.overlay, #subscribe').fadeIn();
    });
    $('.modal_close').on('click', function() {
        $('.overlay, #subscribe').fadeOut();
    });


    // Анимирование скролла по id (якори)
    $('a[href*="#"]').on('click', function (e) {
        e.preventDefault();
       if($('a[href*="#"]').length) {
            $('html, body').animate({
              scrollTop: $($(this).attr('href')).offset().top
            }, 1000, 'swing');
       }
      });


    // Выделение активного пункта в навигационном меню
    $(function() {
        let loc_path = location.pathname.split("/")[1];
        if(loc_path) {
            $('nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('menu_link_active');
        }
    });

    // Выделение активного пункта в навигации разделов
    $(function() {
        let loc_path = location.pathname;
        if(loc_path) {
            $('.sidebar_list a[href$="' + window.location.pathname.split("/").pop() + '"]').addClass('sidebar_item_link_active');
        }
    });

    // Выделение активного пункта в навигации разделов
    $(function() {
        let loc_path = $('.page_title').html();
        if(loc_path) {
            $('.sidebar_list a[href$="/news/section/' + encodeURI(loc_path)).addClass('sidebar_item_link_active');
        }
    });

    // for (let i = 1; i <= 3; i++) {
    //     var rate = document.getElementById("author_rate_" + i).innerHTML;
    //     var line = document.getElementById("author_rate_bar_" + i);
    //     line.style.width = rate * 10 + '%';
    // }
    //
    // var finalRate = document.getElementById("author_rate_4").innerHTML;
    // var toplineRate = document.getElementById("author_rate_bar_4");
    // var contentRate = document.getElementById("content_item_topline_rate");
    // var multiply = finalRate * 40;
    // if (finalRate < 5) {
    //     toplineRate.style.backgroundColor = 'rgba(200,' + multiply + ',0,1)';
    //     contentRate.style.borderColor = 'rgba(200,' + multiply + ',0,1)';
    // }
    // else {
    //     toplineRate.style.backgroundColor = 'rgba(' + (200 - (multiply-200)) + ',200,0,1)';
    //     contentRate.style.borderColor = 'rgba(' + (200 - (multiply-200)) + ',200,0,1)';
    // }
});