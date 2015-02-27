/*!	
 * scribe 1.0
 *
 * 2014, PixelGrapes http://pixelgrapes.com
 *
 */
/*-----------------------------------------------------------------------------------*/
/* Parallax
/*-----------------------------------------------------------------------------------*/
jQuery(function () {

    jQuery.stellar({
        horizontalScrolling: false,
        verticalOffset: 40
    });

});

/*-----------------------------------------------------------------------------------*/
/* Smooth Scroll
/*-----------------------------------------------------------------------------------*/
jQuery('a[href*=#]:not([href=#])').click(function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

        var target = jQuery(this.hash);
        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
            jQuery('html,body').animate({
                scrollTop: target.offset().top - 100
            }, 1000);
            return false;
        }
    }
});

/*-----------------------------------------------------------------------------------*/
/* App Showcase
/*-----------------------------------------------------------------------------------*/

var AppShowcase = (function () {

    var $el = jQuery('#sc-wrapper'),
        // device element
        $device = $el.find('.sc-device'),
        // the device image wrapper
        $trigger = $device.children('a:first'),
        // the screens
        $screens = $el.find('.sc-grid > a'),
        // the device screen image
        $screenImg = $device.find('img').css('transition', 'all 0.5s ease'),
        $screenText = $device.find('.sc-text'),
        // the device screen title
        $screenTitle = $el.find('.sc-title'),

        // navigation arrows
        $nav = $device.find('nav'),
        $navPrev = $nav.children('span:first'),
        $navNext = $nav.children('span:last'),
        // current screen´s element index
        current = 0,
        // if navigating is in process
        animating = false,
        // total number of screens
        screensCount = $screens.length,
        // csstransitions support
        support = Modernizr.csstransitions,
        // transition end event name
        transEndEventNames = {
            'WebkitTransition': 'webkitTransitionEnd',
            'MozTransition': 'transitionend',
            'OTransition': 'oTransitionEnd',
            'msTransition': 'MSTransitionEnd',
            'transition': 'transitionend'
        },
        transEndEventName = transEndEventNames[Modernizr.prefixed('transition')],
        // HTML Body element
        $body = jQuery('body');

    function init() {
        // show grid
        $trigger.on('click', showGrid);
        // when a grid´s screen is clicked, show the respective image on the device
        $screens.on('click', function () {
            showScreen(jQuery(this));
            return false;
        });
        // navigate
        $navPrev.on('click', function () {
            navigate('prev');
            return false;
        });
        $navNext.on('click', function () {
            navigate('next');
            return false;
        });
    }

    function showGrid() {
        $el.addClass('sc-gridview');
        // clicking somewhere else on the page closes the grid view
        $body.off('click').on('click', function () {
            showScreen();
        });
        return false;
    }

    function showScreen($screen) {
        $el.removeClass('sc-gridview');
        if ($screen) {
            // update current
            current = $screen.index();
            // update image and title on the device
            $screenImg.attr('src', $screen.find('img').attr('src'));
            $screenTitle.text($screen.find('span').text());

            $screenText.html($screen.find('span3').html());
        }
    }

    function navigate(direction) {

        if (animating) {
            return false;
        }

        animating = true;

        if (direction === 'next') {
            current = current < screensCount - 1 ? ++current : 0;
        } else if (direction === 'prev') {
            current = current > 0 ? --current : screensCount - 1;
        }

        // next screen to show
        var $nextScreen = $screens.eq(current);

        if (support) {

            // append new image to the device
            var $nextScreenImg = jQuery('<img src="' + $nextScreen.find('img').attr('src') + '"></img>').css({
                transition: 'all 0.5s ease',
                opacity: 0,
                transform: direction === 'next' ? 'scale(0.9)' : 'translateY(100px)'
            }).insertBefore($screenImg);

            // update title
            $screenTitle.text($nextScreen.find('span').text());

            $screenText.html($nextScreen.find('span3').html());
            setTimeout(function () {

                // current image fades out / new image fades in
                $screenImg.css({
                    opacity: 0,
                    transform: direction === 'next' ? 'translateY(100px)' : 'scale(0.9)'
                }).on(transEndEventName, function () {
                    jQuery(this).remove();
                });

                $nextScreenImg.css({
                    opacity: 1,
                    transform: direction === 'next' ? 'scale(1)' : 'translateY(0px)'
                }).on(transEndEventName, function () {
                    $screenImg = jQuery(this).off(transEndEventName);
                    animating = false;
                });

            }, 25);

        } else {
            // update image and title on the device
            $screenImg.attr('src', $nextScreen.find('img').attr('src'));
            $screenTitle.text($nextScreen.find('span').text());

            animating = false;
        }

    }

    return {
        init: init
    };

})();




jQuery(document).ready(function () {

    /*-----------------------------------------------------------------------------------*/
    /* Tabs Widget
/*-----------------------------------------------------------------------------------*/
    jQuery(".tab_content").hide();
    jQuery("ul.tabs li:first").addClass("active").show();
    jQuery(".tab_content:first").show();
    jQuery("ul.tabs li").click(function () {
        jQuery("ul.tabs li").removeClass("active");
        jQuery(this).addClass("active");
        jQuery(".tab_content").hide();
        var activeTab = jQuery(this).find("a").attr("href");
        if (jQuery.browser.msie) {
            jQuery(activeTab).show();
        } else {
            jQuery(activeTab).fadeIn();
        }
        return false;
    });


    /*-----------------------------------------------------------------------------------*/
    /* Footer
/*-----------------------------------------------------------------------------------*/



    jQuery('#fill').css('height', window.innerHeight + 'px');
    jQuery('#stubby').css('min-height', window.innerHeight + 'px');


    jQuery('#footer').css({
        position: 'fixed',
        left: (jQuery(window).width() - jQuery('#footer').outerWidth()) / 2,
        top: (jQuery(window).height() - jQuery('#footer').outerHeight()) / 2
    });

    jQuery(window).resize(function () {

        jQuery('#fill').css('height', window.innerHeight + 'px');
        jQuery('#stubby').css('min-height', window.innerHeight + 'px');
        jQuery('#footer').css({
            position: 'fixed',
            left: (jQuery(window).width() - jQuery('#footer').outerWidth()) / 2,
            top: (jQuery(window).height() - jQuery('#footer').outerHeight()) / 2
        });
    });

    /*-----------------------------------------------------------------------------------*/
    /* Progress Bars
/*-----------------------------------------------------------------------------------*/
    setTimeout(function () {

        jQuery('.progress .bar').each(function () {
            var me = jQuery(this);
            var perc = me.attr("data-percentage");


            var current_perc = 0;

            var progress = setInterval(function () {
                if (current_perc >= perc) {
                    clearInterval(progress);
                } else {
                    current_perc += 1;
                    me.css('width', (current_perc) + '%');
                }

                me.text((current_perc) + '%');

            }, 20);

        });

    }, 900);

    /*-----------------------------------------------------------------------------------*/
    /* FeatureBox
/*-----------------------------------------------------------------------------------*/
    jQuery('.featurebox').each(function (i) {
        jQuery(this).delay(i * 600).fadeIn();
    });

    /*-----------------------------------------------------------------------------------*/
    /* Tweets
/*-----------------------------------------------------------------------------------*/
    jQuery(".tweet .e-entry-title").css("color", "#ffffff");


    /*-----------------------------------------------------------------------------------*/
    /* Tooltips
/*-----------------------------------------------------------------------------------*/
    jQuery('[data-tip]').each(function () {
        jQuery(this).tooltip({
            placement: jQuery(this).data('tip')
        });
    });

    /*-----------------------------------------------------------------------------------*/
    /* Carousel
/*-----------------------------------------------------------------------------------*/
    jQuery('.carousel').carousel({
        interval: 6000,
        pause: 'hover'
    });
});

/*-----------------------------------------------------------------------------------*/
/* Flex Slider
/*-----------------------------------------------------------------------------------*/


jQuery('.flexslider').flexslider({
    animation: "fade",
    slideshow: true,
    prevText: "",
    nextText: ""
});


jQuery('.video').fitVids();

/*-----------------------------------------------------------------------------------*/
/* Drop-down hover
/*-----------------------------------------------------------------------------------*/
/*
 * Project: Twitter Bootstrap Hover Dropdown
 * Author: Cameron Spear
 * Contributors: Mattia Larentis
 *
 * Dependencies?: Twitter Bootstrap's Dropdown plugin
 *
 * A simple plugin to enable twitter bootstrap dropdowns to active on hover and provide a nice user experience.
 *
 * No license, do what you want. I'd love credit or a shoutout, though.
 *
 * http://cameronspear.com/blog/twitter-bootstrap-dropdown-on-hover-plugin/
 */
(function (e, t, n) {
    var r = e();
    e.fn.dropdownHover = function (n) {
        r = r.add(this.parent());
        return this.each(function () {
            var n = e(this).parent(),
                i = {
                    delay: 500,
                    instantlyCloseOthers: !0
                },
                s = {
                    delay: e(this).data("delay"),
                    instantlyCloseOthers: e(this).data("close-others")
                },
                o = e.extend(!0, {}, i, o, s),
                u;
            n.hover(function () {
                o.instantlyCloseOthers === !0 && r.removeClass("open");
                t.clearTimeout(u);
                e(this).addClass("open")
                jQuery('li.dropdown > ul').addClass("pullDown");
            }, function () {
                u = t.setTimeout(function () {
                    n.removeClass("open")
                    jQuery('li.dropdown > ul').removeClass("pullDown");
                }, o.delay)
            })
        })
    };
    e('[data-hover="dropdown"]').dropdownHover()
})(jQuery, this);

/*-----------------------------------------------------------------------------------*/
/* Animations
/*-----------------------------------------------------------------------------------*/

jQuery('.sc-tour-text:first').each(function () {

    jQuery(this).addClass("slideLeft");
    jQuery(this).css("visibility", "visible");
});
jQuery('.sc-tour img:first').each(function () {

    jQuery(this).addClass("slideRight");
    jQuery(this).css("visibility", "visible");
});
jQuery('.tour-icon:first').each(function () {

    jQuery(this).addClass("fadeIn sc-color");
    jQuery(this).css("visibility", "visible");
});
jQuery('.sc-blog-pow:first').delay(1000).each(function () {
    jQuery(this).addClass("slideLeft");
    jQuery(this).css("visibility", "visible");
});

/*-----------------------------------------------------------------------------------*/
/* Scroll Animations
/*-----------------------------------------------------------------------------------*/


jQuery(window).scroll(function () {
    jQuery('.sc-highlightleft .feature-box').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideRight");
        }
    });
    jQuery('.sc-highlightright .feature-box').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideLeft");
        }
    });
    jQuery('.sc_up').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideUp");
        }
    });

    jQuery('.sc-icon').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideExpandUp");
        }
    });
    jQuery('.sc-pow').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideUp");
        }
    });
    jQuery('.sc-blog-pow').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 650) {
            jQuery(this).addClass("slideLeft");
        }
    });
    jQuery('.sc-stretch-banner .overlay1').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideRight");
        }
    });
    jQuery('.sc-stretch-banner .overlay2').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {

            jQuery(this).addClass("slideLeft");

        }
    });
    jQuery('.tour-icon').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("fadeIn sc-color");
        }
    });
    jQuery('.sc-tour-text').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideLeft");
        }
    });

    jQuery('.sc-tour img').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideRight");
        }
    });

    jQuery('.sc-header-img').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideLeft");
        }
    });

    jQuery('.sc-growUp').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideExpandUp");
        }
    });

    if (jQuery(document).scrollTop() == 0) {
        jQuery('.sc-nav').removeClass('shrink');
    } else {
        jQuery('.sc-nav').addClass('shrink');
    }

    jQuery('.heading-pow').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 200) {
            jQuery(this).addClass("slideDown");
        }
    });

    jQuery('.p-table-table:first').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideRight");
        }
    });
    jQuery('.p-table-table:last').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideLeft");
        }
    });
    jQuery('.p-table-table').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("slideUp");
        }
    });
    jQuery('.scr-device').each(function () {
        var imagePos = jQuery(this).offset().top;

        var topOfWindow = jQuery(window).scrollTop();
        if (imagePos < topOfWindow + 600) {
            jQuery(this).addClass("fadeIn");
        }
    });
    jQuery('.timer').each(function () {
        if (jQuery(this).hasClass("element-visible")) {
            // do nothing
        } else {
            var imagePos = jQuery(this).offset().top;

            var topOfWindow = jQuery(window).scrollTop();
            if (imagePos < topOfWindow + 500) {
                jQuery(this).addClass("element-visible");
                jQuery(this).countTo();
            }
        }
    });


});


/*-----------------------------------------------------------------------------------*/
/* Preloader
/*-----------------------------------------------------------------------------------*/

jQuery(".loader").delay(1000).fadeOut("slow")