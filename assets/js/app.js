 /* globals $:false */
 var width = $(window).width(),
     height = $(window).height(),
     content,
     mainSlider,
     footer = false,
     isMobile = false,
     $root = '/';
 $(function() {
     var app = {
         init: function() {
             $(window).resize(function(event) {});
             $(document).ready(function($) {
                 $body = $('body');
                 $header = $('header');
                 $container = $('#container');
                 app.sizeSet();
                 if ('scrollRestoration' in history) {
                     history.scrollRestoration = 'manual';
                 }
                 if (Modernizr.localstorage) {
                     localStorage.setItem('scrollTop-' + $('#container #page-content').data('id'), 0);
                 }
                 History.Adapter.bind(window, 'statechange', function() {
                     var State = History.getState();
                     console.log(State);
                     content = State.data;
                     $body.addClass('loading');
                     if (content.type == 'page') {
                         $body.addClass('page');
                         app.loadContent(State.url, $container, '#page-content');
                     } else {
                         app.loadContent(State.url, $container, '#page-content');
                     }
                 });
                 $body.on('click', '[data-target]', function(event) {
                     event.preventDefault();
                     var $el = $(this);
                     var target = $el.data('target');
                     if (Modernizr.localstorage) {
                         localStorage.setItem('scrollTop-' + $('#container #page-content').data('id'), $(window).scrollTop());
                     }
                     if (target == 'page') {
                         History.pushState({
                             type: 'page'
                         }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                     } else {
                         app.goIndex();
                     }
                     $('#category-menu').removeClass('open');
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
                 $body.on('click', '[event-target="category"]', function(event) {
                     event.preventDefault();
                     $('#category-menu').toggleClass('open');
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
                         $(".loader").fadeOut(200, function() {
                             $body.addClass('loaded');
                         });
                     }, 1500);
                 });
                 $(window).scroll(function(event) {
                     var scrollTop = $(window).scrollTop();
                     if (scrollTop > height / 5) {
                         $('#featured-projects').addClass('no-invite');
                     }
                     //if (scrollTop > height * 0.7 - headerHeight) {
                     if (scrollTop >= headerHeight) {
                         $header.addClass('hide');
                     } else {
                         $header.removeClass('hide');
                     }
                     if (scrollTop >= 30 + headerHeight) {
                         $header.addClass('reduced');
                     } else {
                         $header.removeClass('reduced');
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
             headerHeight = $('#site-title').height();
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
                 controls: ['play-large'],
                 iconUrl: "/assets/images/plyr.svg"
             });
             $players = $('.js-player');
             if (players && players.length > 0) {
                 $(players).each(function(index, el) {
                     el.played = false;
                 });
                 checkScroll();
                 window.addEventListener('scroll', checkScroll, false);
                 window.addEventListener('resize', checkScroll, false);
             }

             function checkScroll() {
                 for (var i = 0; i < players.length; i++) {
                     if (!players[i].played) {
                         if ($players.eq(i).isOnScreen()) {
                             players[i].play();
                             players[i].played = true;
                         } else {
                             return;
                         }
                     }
                 }
             }
         },
         loadProjects: function() {
             $projectsGrid = $('#projects').packery({
                 itemSelector: '.project-item',
                 columnWidth: '.grid-sizer',
                 gutter: '.gutter-sizer',
                 //percentPosition: true,
                 transitionDuration: 0,
             });
             $projectsGrid.imagesLoaded().progress(function() {
                 $projectsGrid.packery();
             });
         },
         loadSlider: function() {
             mainSlider = $('#featured-projects.case-study').flickity({
                 cellSelector: '.featured-item',
                 imagesLoaded: false,
                 bgLazyLoad: 2,
                 accessibility: false,
                 wrapAround: true,
                 prevNextButtons: false,
                 pageDots: true,
                 draggable: true
             });
             $('#featured-projects.animated').flickity({
                 cellSelector: '.featured-item',
                 imagesLoaded: false,
                 bgLazyLoad: 2,
                 autoPlay: 500,
                 pauseAutoPlayOnHover: false,
                 accessibility: false,
                 wrapAround: true,
                 prevNextButtons: false,
                 pageDots: false,
                 draggable: false
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
                     setTimeout(function() {
                         app.plyr(true);
                         app.loadSlider();
                         if (content.type == 'page') {
                             app.loadProjects();
                             setTimeout(function() {
                                 $body.addClass('page loaded').removeClass('home loading');
                             }, 300);
                         } else {
                             app.loadProjects();
                             if (Modernizr.localstorage) {
                                 var id = $('#container #page-content').data('id');
                                 var scrollTop = localStorage.getItem('scrollTop-' + id) || 0;
                                 console.log('GET: ' + 's-' + id + "= " + scrollTop);
                                 $(window).scrollTop(scrollTop);
                             }
                             setTimeout(function() {
                                 $body.addClass('home loaded').removeClass('page loading');
                             }, 300);
                         }
                     }, 100);
                 });
             }, 300);
         },
     };
     app.init();
 });
 $.fn.isOnScreen = function() {
     var win = $(window);
     var viewport = {
         top: win.scrollTop(),
         left: win.scrollLeft()
     };
     viewport.right = viewport.left + win.width();
     viewport.bottom = viewport.top + win.height();
     var bounds = this.offset();
     bounds.right = bounds.left + this.outerWidth();
     bounds.bottom = bounds.top + this.outerHeight();
     return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
 };