(function (e) {
    wp.customize("blogname", function (t) {
        t.bind(function (t) {
            e(".logo-text a").html(t)
        })
    });
    wp.customize("sc_background_color", function (t) {
        t.bind(function (t) {
            e("body").css("background", t);
        })
    });
    
    wp.customize("highlight_color", function (t) {
        t.bind(function (t) {
            e(".sc_select a, .btn, #searchsubmit, #submit, .wpcf7-submit, .featurebox-icon, .p-table-table .featured .p-table-header, .progress-striped .bar, .sc-date-wrap, .sc-tour .container .tour-icon, .hi-icon-effect-1 .hi-icon, .twit-banner, .foot-sidebar input[type='submit']").css("background-color", t);
            e("ul.social li a,.sc_stats .fa,.sticky h2,.nav-tabs > li > a, .pagination ul > li > a, .pagination ul > li > span, .scr-icon, .sc-info h2, .feature-box .sc-highlight-icon, #container #menu-wrap .menu-item span, #changingtext span").css("color", t);
            e("#back-to-top, .plus, .sidebar .tagcloud a, .scribeFadeIn .dropdown-menu > li > a").hover(function () {
                e(this).css("background-color", t)
            }, function () {
                e(this).css("background-color", "")
            });
            e(".right .col-md-3 li a").hover(function () {
                e(this).css("color", t)
            }, function () {
                e(this).css("color", "")
            });
            e(".footer .tagcloud a, .aq-block-pg_slider_block .hollow.btn").hover(function () {
                e(this).css("border-color", t)
            }, function () {
                e(this).css("border-color", "")
            })
            e(".sc-tags a, ul.social li").hover(function () {
                e(this).css("background", t)
            }, function () {
                e(this).css("background", "")
            })
            
        })
    });
    wp.customize("body_font", function (t) {
        t.bind(function (t) {
            e("body").css("font-family", t);
            WebFontConfig = {
                google: {
                    families: [t]
                }
            };
            (function () {
                var e = document.createElement("script");
                e.src = ("https:" == document.location.protocol ? "https" : "http") + "://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
                e.type = "text/javascript";
                e.async = "true";
                var t = document.getElementsByTagName("script")[0];
                t.parentNode.insertBefore(e, t)
            })()
        })
    });
   
   
})(jQuery)