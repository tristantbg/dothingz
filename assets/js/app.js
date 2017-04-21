 /* globals $:false */
 var width = $(window).width(),
     height = $(window).height(),
     content,
     mainSlider,
     footer = false,
     isMobile = false,
     $root = '/dothings';
 $(function() {
     var app = {
         init: function() {
             $(window).resize(function(event) {});
             $(document).ready(function($) {
                 $body = $('body');
                 $header = $('header');
                 $container = $('#container');
                 app.sizeSet();
                 History.Adapter.bind(window, 'statechange', function() {
                     var State = History.getState();
                     console.log(State);
                     content = State.data;
                     $body.addClass('loading');
                     if (content.type == 'page') {
                         app.loadContent(State.url, $container, '#page-content');
                     } else {
                         app.loadContent(State.url, $container, '#page-content');
                     }
                 });
                 $body.on('click', '[data-target]', function(event) {
                     event.preventDefault();
                     var $el = $(this);
                     var target = $el.data('target');
                     if (target == 'page') {
                         History.pushState({
                             type: 'page'
                         }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                     } else {
                         app.goIndex();
                     }
                 });
                 $body.on('click', '[event-target="readmore"]', function(event) {
                     event.preventDefault();
                     //$(this).parent().addClass('readmore-open');
                     var el = $(this);
                     el.addClass('clicked');
                     setTimeout(function() {
                         el.find('.project-readmore').slideDown(500);
                     }, 400);
                 });
                 $body.on('click', '[event-target="footer"]', function(event) {
                     event.preventDefault();
                     footer = true;
                     $("footer").css({
                         position: 'fixed',
                         transform: 'translateY(-100%) translateZ(0)'
                     });
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
                     setTimeout(function() {
                         app.plyr(true);
                         app.loadProjects();
                         app.loadSlider();
                         $(".loader").fadeOut(500, function() {
                             $body.addClass('loaded');
                         });
                     }, 1500);
                 });
                 $(window).scroll(function(event) {
                     if ($(window).scrollTop() > height - headerHeight) {
                         $header.addClass('grey');
                     } else {
                         $header.removeClass('grey');
                     }
                     if (footer) {
                         $("footer").css('transform', 'none');
                         setTimeout(function() {
                             $("footer").attr('style', '');
                         }, 700);
                         footer = false;
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
         plyr: function(loop) {
             players = plyr.setup('.js-player', {
                 loop: loop,
                 iconUrl: "/dothings/assets/images/plyr.svg"
             });
             if (players && players.length > 0) {
                 $(players).each(function(index, el) {
                     el.played = false;
                 });
             }
             var videos = document.getElementsByClassName("js-player");

             function checkScroll() {
                 for (var i = 0; i < players.length; i++) {
                     if (!players[i].played) {
                         var video = videos[i];
                         var x = video.offsetLeft,
                             y = video.offsetTop,
                             w = video.offsetWidth,
                             h = video.offsetHeight,
                             r = x + w, //right
                             b = y + h, //bottom
                             visibleX, visibleY, visible;
                         visibleX = Math.max(0, Math.min(w, window.pageXOffset + window.innerWidth - x, r - window.pageXOffset));
                         visibleY = Math.max(0, Math.min(h, window.pageYOffset + window.innerHeight - y, b - window.pageYOffset));
                         visible = visibleX * visibleY / (w * h);
                         if (visible < 1 / 4) {
                             players[i].play();
                             players[i].played = true;
                         } else {
                             return;
                         }
                     }
                 }
             }
             window.addEventListener('scroll', checkScroll, false);
             window.addEventListener('resize', checkScroll, false);
         },
         loadProjects: function() {
             $('#projects').packery({
                 itemSelector: '.project-item',
                 columnWidth: '.grid-sizer',
                 gutter: '.gutter-sizer',
                 //percentPosition: true,
                 transitionDuration: 0,
             });
         },
         loadSlider: function() {
             mainSlider = $('#featured-projects').flickity({
                 cellSelector: '.featured-item',
                 imagesLoaded: false,
                 bgLazyLoad: 2,
                 //autoPlay: 500,
                 //setGallerySize: false,
                 accessibility: false,
                 wrapAround: true,
                 prevNextButtons: false,
                 pageDots: true,
                 draggable: true
             });
             $('.slider-section').flickity({
                 cellSelector: '.gallery-cell',
                 imagesLoaded: true,
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
         loadContent: function(url, target, container) {
             setTimeout(function() {
                 $(window).scrollTop(0);
                 $(target).load(url + ' ' + container, function(response) {
                     if (content.type == 'page') {
                         setTimeout(function() {
                             $body.addClass('page loaded').removeClass('home loading');
                             app.plyr(true);
                             app.loadSlider();
                         }, 100);
                     } else {
                         setTimeout(function() {
                             $body.addClass('home loaded').removeClass('page loading');
                             app.plyr(true);
                             app.loadProjects();
                             app.loadSlider();
                         }, 100);
                     }
                 });
             }, 300);
         },
     };
     app.init();
 });