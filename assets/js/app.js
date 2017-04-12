/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    mainSlider,
    isMobile = false,
    $root = '/';
$(function() {
    var app = {
        init: function() {
            $(window).resize(function(event) {});
            $(document).ready(function($) {
                $body = $('body');
                $header = $('header');
                app.sizeSet();
                History.Adapter.bind(window, 'statechange', function() {
                    var State = History.getState();
                    console.log(State);
                    var content = State.data;
                    if (content.type == 'project') {
                        $body.addClass('project loading');
                        app.loadContent(State.url + '/ajax', slidecontainer);
                    }
                });
                $body.on('click', '.readmore', function(event) {
                    event.preventDefault();
                    //$(this).parent().addClass('readmore-open');
                    var el = $(this);
                    el.addClass('clicked');
                    setTimeout(function() {
                        el.find('.project-readmore').slideDown(500);
                    }, 400);
                });
                $(document).keyup(function(e) {
                    //esc
                    if (e.keyCode === 27) app.goIndex();
                    //left
                    if (e.keyCode === 37 && $slider) app.goPrev($slider);
                    //right
                    if (e.keyCode === 39 && $slider) app.goNext($slider);
                });
                $(window).load(function() {
                    app.loadSlider();
                    $(".spinner").fadeOut('300', function() {
                        $(".loader").fadeOut(500);
                        $body.addClass('loaded');
                    });
                });
                $(window).scroll(function(event) {
                  if ($(window).scrollTop() > height - headerHeight) {
                    $header.addClass('grey');
                  } else {
                    $header.removeClass('grey');
                  }
                });
                window.onpageshow = function(event) {
                    setTimeout(function() {
                        $body.removeClass('loading').addClass('loaded');
                    }, 150);
                };
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            headerHeight = $header.height();
            if (width <= 770 || Modernizr.touch) isMobile = true;
            if (isMobile) {
                if (width >= 770) {
                    //location.reload();
                    isMobile = false;
                }
            }
        },
        loadSlider: function() {
            mainSlider = $('#featured-projects').flickity({
                cellSelector: '.featured-item',
                imagesLoaded: false,
                bgLazyLoad: 1,
                //setGallerySize: false,
                accessibility: false,
                wrapAround: true,
                prevNextButtons: false,
                pageDots: true,
                draggable: true
            });
            $('.slider-section').flickity({
                cellSelector: '.gallery-cell',
                imagesLoaded: false,
                lazyLoad: 1,
                //setGallerySize: false,
                accessibility: false,
                wrapAround: true,
                prevNextButtons: true,
                pageDots: false,
                draggable: true
            });
            setTimeout(function() {
                mainSlider.flickity('resize');
            }, 100);
            mainflkty = mainSlider.data('flickity');
            if (mainflkty) {
                current = mainflkty.selectedIndex;
                $cloneCaption = $('#featured-projects .clone.cta-button');
                placeCaption(mainflkty);
                mainSlider.on('settle.flickity', function() {
                    placeCaption(mainflkty);
                });
                mainSlider.on('select.flickity', function() {
                    if (mainflkty.selectedIndex != current) {
                        $cloneCaption.addClass('hidden');
                    }
                    current = mainflkty.selectedIndex;
                });
                mainSlider.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
                    if (!cellElement) {
                        return;
                    }
                    app.goNext(mainSlider);
                });
            }
            // $slider.click(function(event) {
            //     if (!isMobile) {
            //         event.preventDefault();
            //         if ($body.hasClass('hover-left')) {
            //             app.goPrev($slider);
            //         } else if ($body.hasClass('hover-right')) {
            //             app.goNext($slider);
            //         }
            //     }
            // });
            function placeCaption(flkty) {
                if (flkty) {
                    var slidecaption = $(flkty.selectedElement).find('.cta-button').html();
                    if (typeof slidecaption !== typeof undefined && slidecaption !== false) {
                        $cloneCaption.html(slidecaption).removeClass('hidden');
                    }
                }
            }
        },
        goNext: function($slider) {
            $slider.flickity('next', false);
        },
        goPrev: function($slider) {
            $slider.flickity('previous', false);
        },
        goIndex: function() {
            History.pushState({
                type: 'index'
            }, $sitetitle, window.location.origin + $root);
        },
        loadContent: function(url, target) {
            $.ajax({
                url: url,
                success: function(data) {
                    $(target).html(data);
                }
            });
        }
    };
    app.init();
});