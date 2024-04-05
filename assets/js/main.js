(function ($) {
    "use strict";

    // Initiate the wowjs
    new WOW().init();


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 90) {
            $('.nav-bar').addClass('nav-sticky');
            $('.carousel, .page-header').css("margin-top", "73px");
        } else {
            $('.nav-bar').removeClass('nav-sticky');
            $('.carousel, .page-header').css("margin-top", "0");
        }
    });


    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });


    // jQuery counterUp
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })
    });


    // Testimonial Slider
    $('.testimonial-slider').slick({
        infinite: true,
        autoplay: true,
        arrows: false,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.testimonial-slider-nav'
    });
    $('.testimonial-slider-nav').slick({
        arrows: false,
        dots: false,
        focusOnSelect: true,
        centerMode: true,
        centerPadding: '22px',
        slidesToShow: 3,
        asNavFor: '.testimonial-slider'
    });
    $('.testimonial .slider-nav').css({ "position": "relative", "height": "160px" });


    // Blogs carousel
    $(".related-slider").owlCarousel({
        autoplay: true,
        dots: false,
        loop: true,
        nav: true,
        navText: [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 2
            }
        }
    });


    // Portfolio isotope and filter
    var portfolioIsotope = $('.portfolio-container').isotope({
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
    });

    $('#portfolio-flters li').on('click', function () {
        $("#portfolio-flters li").removeClass('filter-active');
        $(this).addClass('filter-active');

        portfolioIsotope.isotope({ filter: $(this).data('filter') });
    });

})(jQuery);

document.addEventListener("DOMContentLoaded", function () {
    var selectElement = document.getElementById('suivit_filter_operation');
    var sujetField = document.getElementById('sujetField');

    // Vérifier le changement dans le champ "operation"
    selectElement.addEventListener('change', function () {
        // Vérifier si une valeur est sélectionnée dans le champ "operation"
        if (this.value !== '') {
            sujetField.style.display = 'block'; // Afficher le champ "sujet"
            loadSujets(); // Charger les sujets correspondants
        } else {
            sujetField.style.display = 'none'; // Masquer le champ "sujet"
        }
    });
});

function loadSujets() {
    // Récupérer la valeur sélectionnée du champ "operation"
    var selectedNature = document.querySelector('input[name="suivit_filter[operation]"]:checked').value;

    // Faire une requête AJAX pour récupérer les sujets en fonction de la nature sélectionnée
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var sujets = JSON.parse(xhr.responseText);
                updateSujetsDropdown(sujets);
            } else {
                console.error('Erreur lors de la récupération des sujets : ' + xhr.status);
            }
        }
    };
    xhr.open('GET', '/suivit/get-sujets?nature=' + selectedNature);
    xhr.send();
}

function updateSujetsDropdown(sujets) {
    var sujetDropdown = document.getElementById('suivit_filter_sujet');
    if (!sujetDropdown) {
        console.error("Element with ID 'suivit_filter_sujet' not found");
        return;
    }

    sujetDropdown.innerHTML = ''; // Efface les anciennes options
    sujets.forEach(function (sujet) {
        var option = document.createElement('option');
        option.value = sujet.id;
        option.textContent = sujet.sujet;
        sujetDropdown.appendChild(option);
    });
}
