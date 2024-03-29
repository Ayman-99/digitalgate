$(document).ready(function () {
    "use strict"; // start of use strict

    /*==============================
    Scroll
    ==============================*/
    $('.DataTableToDisplay').DataTable();
    var mainHeader = $('.header');
    var scrolling = false,
        previousTop = 0,
        currentTop = 0,
        scrollDelta = 10,
        scrollOffset = 140;

    var scrolling = false;
    $(window).on('scroll', function () {
        if (!scrolling) {
            scrolling = true;
            (!window.requestAnimationFrame)
                ? setTimeout(autoHideHeader, 250)
                : requestAnimationFrame(autoHideHeader);
        }
    });
    $(window).trigger('scroll');

    function autoHideHeader() {
        var currentTop = $(window).scrollTop();
        checkSimpleNavigation(currentTop);
        previousTop = currentTop;
        scrolling = false;
    }

    function checkSimpleNavigation(currentTop) {
        if (previousTop - currentTop > scrollDelta) {
            mainHeader.removeClass('header--scroll');
        } else if (currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
            mainHeader.addClass('header--scroll');
        }
    }

    function disableScrolling() {
        var x = window.scrollX;
        var y = window.scrollY;
        window.onscroll = function () {
            window.scrollTo(x, y);
        };
    }

    function enableScrolling() {
        window.onscroll = function () {
        };
    }
    function root() {
        var scripts = document.getElementsByTagName('script'),
            script = scripts[scripts.length - 1],
            path = script.getAttribute('src').split('/'),
            pathname = location.pathname.split('/'),
            notSame = false,
            same = 0;

        for (var i in path) {
            if (!notSame) {
                if (path[i] == pathname[i]) {
                    same++;
                } else {
                    notSame = true;
                }
            }
        }
        return location.origin + pathname.slice(0, same).join('/');
    }

    $('.js-example-basic-single').select2();
    /*
       Custom
     */
    $('.removeFromCart').click(function (e) {
        var data = $(this).data('product');
        var token = $(this).data('token');
        var button = $(this);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: root() + "/shop/cart",
            type: "DELETE",
            async: !1,
            cache: !0,
            data: {
                "_token": token,
                "p_id": data
            },
            success: function (t, e, s) {
                if (t.status == "errorInCart") {
                    $.notify({
                        // options
                        message: t.message,
                    }, {
                        // settings
                        type: "info",
                        delay: 500,
                        timer: 400
                    });
                } else {
                    button.closest('tr').remove();
                    var total = parseFloat($('#userBalance').text().substring(1));
                    total = total - parseFloat(t.p_price);
                    $('#userBalance').text("$" + total.toFixed(2));
                    $('#subtotalFromCheckoutForJs').text("$" + total.toFixed(2));
                    $('#checkoutTotal').text(total.toFixed(2));
                    $('#cartNotification').text(t.cartCount);
                    $.notify({
                        // options
                        message: t.message,
                    }, {
                        // settings
                        type: "success",
                        delay: 500,
                        timer: 400
                    });
                }
            },
            error: function (t, e, s) {
                alert(t.responseText);
                console.log("error " + t.status);
            },
        });
    });
    $('.addToCart').click(function (e) {
        var data = $(this).data('product');
        var token = $(this).data('token');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: root() + "/shop/cart",
            type: "POST",
            async: !1,
            cache: !0,
            data: {
                "_token": token,
                "p_id": data
            },
            success: function (t, e, s) {
                if (t.status == "errorInCart") {
                    $.notify({
                        // options
                        message: t.message,
                    }, {
                        // settings
                        type: "info",
                        delay: 500,
                        timer: 400
                    });
                } else {
                    var total = parseFloat($('#userBalance').text().substring(1));
                    total = total + parseFloat(t.p_price);
                    $('#userBalance').text("$" + total.toFixed(2));
                    $('#cartNotification').text(t.cartCount);
                    $.notify({
                        // options
                        message: t.message,
                    }, {
                        // settings
                        type: "success",
                        delay: 500,
                        timer: 400
                    });
                }
            },
            error: function (t, e, s) {
                alert(t.responseText);
                console.log("error " + t.status);
            },
        });
    });
    $(".unlockDeletingProducts").on('click', function (e) {
        Swal.fire({
            icon: 'warning',
            title: 'Do you want to enable deleting?',
            html: "<p style='color:red'>All associated items with the deleted object will be deleted as far as they are not used</p>",
            showCancelButton: true,
            confirmButtonText: 'Yes, continue!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('.deletingProductsSubmitForm').removeAttr('disabled');
                sessionStorage.setItem("enableDeletingProducts", "Yes");
            }
        })
    });
    $(".unlockDeletingCategories").on('click', function (e) {
        Swal.fire({
            icon: 'warning',
            title: 'Do you want to enable deleting?',
            html: "<p style='color:red'>All associated items with the deleted object will be deleted as far as they are not used</p>",
            showCancelButton: true,
            confirmButtonText: 'Yes, continue!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('.deletingCategorySubmitForm').removeAttr('disabled');
                sessionStorage.setItem("enableDeletingCategories", "Yes");
            }
        })
    });
    $(".unlockDeletingItems").on('click', function (e) {
        Swal.fire({
            icon: 'warning',
            title: 'Do you want to enable deleting?',
            html: "<p style='color:red'>All associated items with the deleted object will be deleted as far as they are not used</p>",
            showCancelButton: true,
            confirmButtonText: 'Yes, continue!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('.deletingItemsSubmitForm').removeAttr('disabled');
                sessionStorage.setItem("enableDeletingItems", "Yes");
            }
        })
    });
    if (sessionStorage.getItem("enableDeletingProducts") != null) {
        $('.deletingProductsSubmitForm').removeAttr('disabled');
    }
    if (sessionStorage.getItem("enableDeletingCategories") != null) {
        $('.deletingCategorySubmitForm').removeAttr('disabled');
    }
    if (sessionStorage.getItem("enableDeletingItems") != null) {
        $('.deletingItemsSubmitForm').removeAttr('disabled');
    }

    $('.wrapper input[name="rg1"]').change(function(){
        var value = $(this).val();
        var p_id = $('.wrapper input[name="product"]').val();
        var token = $('.wrapper input[name="_token"]').val();
        $('.wrapper input[name="rg1"]').each(function(){ $(this).attr('disabled',''); });
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: root() + "/shop/product/rate",
            type: "POST",
            async: !1,
            cache: !0,
            data: {
                "_token": token,
                "p_id": p_id,
                "value": value
            },
            success: function (t, e, s) {
                $.notify({
                    // options
                    message: t.message,
                }, {
                    // settings
                    type: "success",
                    delay: 500,
                    timer: 400
                });
            },
            error: function (t, e, s) {
                alert(root());
                alert(t.responseText);
                console.log("error " + t.status);
            },
        });
    });

    /*==============================
    Header
    ==============================*/
    $('.header__menu').on('click', function () {
        $('.header__menu').toggleClass('header__menu--active');
        $('.header').toggleClass('header--menu');
        $('.header__nav').toggleClass('header__nav--active');

        if ($('.header__nav').hasClass('header__nav--active')) {
            disableScrolling();
        } else {
            enableScrolling();
        }
    });

    /*==============================
    Bg
    ==============================*/
    $('.section--bg').each(function () {
        if ($(this).attr("data-bg")) {
            $(this).css({
                'background': 'url(' + $(this).data('bg') + ')',
                'background-position': 'center top 140px',
                'background-repeat': 'no-repeat',
                'background-size': 'auto 500px'
            });
        }
    });

    $('.section--head').each(function () {
        if ($(this).attr("data-bg")) {
            $(this).css({
                'background': 'url(' + $(this).data('bg') + ')',
                'background-position': 'center top 140px',
                'background-repeat': 'no-repeat',
                'background-size': 'cover'
            });
        }
    });

    $('.section--full-bg').each(function () {
        if ($(this).attr("data-bg")) {
            $(this).css({
                'background': 'url(' + $(this).data('bg') + ')',
                'background-position': 'center center',
                'background-repeat': 'no-repeat',
                'background-size': 'cover'
            });
        }
    });

    /*==============================
    Section carousel
    ==============================*/
    $('.section__carousel--big').owlCarousel({
        mouseDrag: true,
        touchDrag: true,
        dots: false,
        loop: true,
        autoplay: false,
        smartSpeed: 700,
        margin: 20,
        autoHeight: true,
        autoWidth: true,
        responsive: {
            0: {
                items: 2,
            },
            576: {
                items: 3,
            },
            768: {
                items: 1,
                margin: 30,
                autoWidth: false,
            },
            1200: {
                items: 2,
                margin: 30,
                autoWidth: false,
                mouseDrag: false,
                touchDrag: false,
            },
        }
    });

    $('.section__carousel--catalog').owlCarousel({
        mouseDrag: true,
        touchDrag: true,
        dots: false,
        loop: true,
        autoplay: false,
        smartSpeed: 700,
        margin: 20,
        autoHeight: true,
        autoWidth: true,
        responsive: {
            0: {
                items: 2,
            },
            576: {
                items: 3,
            },
            768: {
                items: 3,
                margin: 30,
                autoWidth: false,
            },
            992: {
                items: 4,
                margin: 30,
                autoWidth: false,
            },
            1200: {
                items: 5,
                margin: 30,
                autoWidth: false,
                mouseDrag: false,
                touchDrag: false,
            },
        }
    });

    $('.section__nav--prev, .details__nav--prev').on('click', function () {
        var carouselId = $(this).attr('data-nav');
        $(carouselId).trigger('prev.owl.carousel');
    });
    $('.section__nav--next, .details__nav--next').on('click', function () {
        var carouselId = $(this).attr('data-nav');
        $(carouselId).trigger('next.owl.carousel');
    });

    /*==============================
    Partners
    ==============================*/
    $('.partners').owlCarousel({
        mouseDrag: false,
        touchDrag: false,
        dots: false,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        smartSpeed: 700,
        margin: 20,
        responsive: {
            0: {
                items: 2,
            },
            576: {
                items: 2,
                margin: 30,
            },
            768: {
                items: 3,
                margin: 30,
            },
            992: {
                items: 4,
                margin: 30,
            },
            1200: {
                items: 6,
                margin: 30,
            },
        }
    });

    /*==============================
    Details
    ==============================*/
    $('.details__carousel').owlCarousel({
        mouseDrag: true,
        touchDrag: true,
        dots: false,
        loop: true,
        autoplay: false,
        smartSpeed: 700,
        margin: 20,
        autoHeight: true,
        autoWidth: true,
        responsive: {
            0: {
                items: 2,
            },
            576: {
                items: 3,
            },
            768: {
                autoWidth: false,
                items: 4,
            },
            992: {
                autoWidth: false,
                items: 5,
            },
            1200: {
                autoWidth: false,
                items: 6,
            },
        }
    });

    /*==============================
    Modal
    ==============================*/
    $('.post__video').magnificPopup({
        disableOn: 700,
        fixedContentPos: true,
        type: 'iframe',
        preloader: false,
        removalDelay: 300,
        mainClass: 'mfp-fade',
        callbacks: {
            open: function () {
                if ($(window).width() > 1200) {
                    $('.header').css('margin-left', "-" + (getScrollBarWidth() / 2) + "px");
                }
            },
            close: function () {
                if ($(window).width() > 1200) {
                    $('.header').css('margin-left', 0);
                }
            }
        }
    });

    $('.details__carousel a').magnificPopup({
        fixedContentPos: true,
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        removalDelay: 300,
        mainClass: 'mfp-fade',
        image: {
            verticalFit: true
        },
        callbacks: {
            open: function () {
                if ($(window).width() > 1200) {
                    $('.header').css('margin-left', "-" + (getScrollBarWidth() / 2) + "px");
                }
            },
            close: function () {
                if ($(window).width() > 1200) {
                    $('.header').css('margin-left', 0);
                }
            }
        }
    });

    function getScrollBarWidth() {
        var $outer = $('<div>').css({visibility: 'hidden', width: 100, overflow: 'scroll'}).appendTo('body'),
            widthWithScroll = $('<div>').css({width: '100%'}).appendTo($outer).outerWidth();
        $outer.remove();
        return 100 - widthWithScroll;
    };

    /*==============================
    Scroll bar
    ==============================*/
    $('.details__text').mCustomScrollbar({
        axis: "y",
        scrollbarPosition: "outside",
        theme: "custom-bar"
    });

    $('.header__nav-menu--scroll').mCustomScrollbar({
        axis: "y",
        scrollbarPosition: "outside",
        theme: "custom-bar2"
    });

    /*==============================
    Range sliders
    ==============================*/
    function initializeSlider() {
        if ($('#filter__range').length) {
            var firstSlider = document.getElementById('filter__range');
            noUiSlider.create(firstSlider, {
                range: {
                    'min': 1,
                    'max': 100
                },
                step: 1,
                connect: true,
                start: [5, 20],
                format: wNumb({
                    decimals: 0,
                    prefix: '$'
                })
            });
            var firstValues = [
                document.getElementById('filter__range-start'),
                document.getElementById('filter__range-end')
            ];
            firstSlider.noUiSlider.on('update', function (values, handle) {
                firstValues[handle].innerHTML = values[handle];
                $('#minPrice').attr({value: values[0].substring(1)});
                $('#maxPrice').attr({value: values[1].substring(1)});
            });
        } else {
            return false;
        }
        return false;
    }

    $(window).on('load', initializeSlider());

});
