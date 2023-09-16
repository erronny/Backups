 <meta charset="UTF-8">
    <meta name="robots" content="noodp,noydir" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <meta name="description" content="Secure online file storage and sharing from Digistate.in! Store, back-up, share, & access all your files, photos, and documents from any computer and mobile device. Get your Free Online Storage Account Now." />
      <meta name="keywords" content="online storage, online file storage, secure online storage, online data backup, online backup, file storage, online drive, share files online, share photos online, share videos online, photos online, videos online, music online, share music online, photo sharing, video sharing, music sharing, file sharing, store documents online, internet storage, internet drive, virtual hard drive, remote backup, online hard drive, secure online storage, secure online backup, online photo storage, online video storage, online music storage, streaming music, streaming videos, podcasting, secure file sharing, online backup services, online data storage, file storage online, free online storage, internet file storage, backup data, online photo sharing, online file sharing, online video sharing, online music sharing, file hosting, online file hosting, free web storage, web storage, free online drive, online media storage, data backup, rss file sharing, rss feed, personal online space, mobile data access, storage solution, remote access, photo prints, online address book, contacts online, address book, web office, online video, online music, online bookmarks, online favorites, share bookmarks, share favorites, contact management, address book management, bookmark management, online calendar, share calendar, share favorite sites, save files online, internet hard drive, digiestate, Digistate, Digistate.in, digiestate." />
     <link rel="icon" type="image/png" href="{{asset('assets/Icon.png')}}">
      <meta property="og:type" content="website">
      <meta property="og:title" content="Digistate | Free Secure Online Cloud File Storage, Internet File Sharing, Photo & Video Sharing, Music Online, Store & Access Documents, Share Files Online, Online Data Backup">
      <meta property="og:description" content="Secure online file storage and sharing from Digistate.in! Store, back-up, share, & access all your files, photos, and documents from any computer and mobile device. Get your Free Online Storage Account Now.">
      <meta property="og:image" content="http://Digistate.in/img/og_i.jpg">
      <meta property="og:image:secure_url" content="https://Digistate.in/img/og_image.jpg" />
      <meta property="og:url" content="https://Digistate.in">
      <!-- required -->
      <link href='https://fonts.googleapis.com/css?family=Raleway:400,200' rel='stylesheet' type='text/css'> 
      <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/fronts/src/css/normalize.css?rnd=4')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/fronts/src/css/library.shell.css?rnd=4')}}">
      <script type="text/javascript" src="{{asset('assets/fronts/src/js/jquery-2.1.3.min.js?rnd=4')}}"></script>
      <script type="text/javascript" src="{{asset('assets/fronts/src/js/svg4everybody.min.js?rnd=4')}}"></script>
      <script type="text/javascript" src="{{asset('assets/fronts/src/js/history.js?rnd=4')}}"></script>
      <script type="text/javascript" src="{{asset('assets/fronts/src/js/library.core.js?rnd=4')}}"></script>
      <script type="text/javascript" src="{{asset('assets/fronts/src/js/library.shell.js?rnd=4')}}"></script>
      <script type="text/javascript" src="{{asset('assets/fronts/src/js/jquery.jcarousel.min.js?rnd=4')}}"></script>
      <script type="text/javascript" src="{{asset('assets/fronts/src/js/jquery.jcarousel-autoscroll.min.js?rnd=4')}}"></script>
      <!-- application -->
      <link rel="stylesheet" type="text/css" href="{{asset('assets/fronts/src/css/application.css?rnd=4')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/fronts/src/css/layout.common.css?rnd=4')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/fronts/src/css/layout.common.mobile.css?rnd=4')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/fronts/src/css/layout.common.1000-1239.css?rnd=4')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/fronts/src/css/layout.common.768-999.css?rnd=4')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/fronts/src/css/layout.common.480-767.css?rnd=4')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/fronts/src/css/layout.common.0-479.css?rnd=4')}}">
       <link rel="stylesheet" type="text/css" href="{{asset('assets/fronts/src/css/social.css')}}">
      <script type="text/javascript">
         // fix page
         var fixPage = function(action) {
         
             if (action == 'resize' || action == 'init') {
         
                 // fix page height
                 $('.page').css('height', 'auto');
         
                 var
                 windowH = $(window).outerHeight(true),
                 windowW = $(window).outerWidth(true),
                 layoutH = $('.layout').outerHeight(true),
                 pageH = $('.page').outerHeight(true);
         
                 if (layoutH < windowH) {
                     $('.page').css('height', pageH + (windowH - layoutH) + 'px');
                 }
         
                 // stretch home title
                 if ($('.section-home-title').size() > 0) {
                     $('.section-home-title').css('height', 'auto');
         
                     var
                     sectionHomeTitleH = $('.section-home-title').outerHeight(true),
                     sectionHomeTitleP = Math.round($('.section-home-title').position().top);
         
                     if (sectionHomeTitleH && windowW > 768) {
                         if (sectionHomeTitleH + sectionHomeTitleP < windowH) {
                             $('.section-home-title').css('height', windowH - sectionHomeTitleP - 80 + 'px');
                         }
                     }
                 }
         
             }
         
             // get current situation
             var
             layoutHeadH = $('.layout-head').outerHeight(true),
             layoutBodyH = $('.layout-body').outerHeight(true),
             layoutFootH = $('.layout-foot').outerHeight(true),
             layoutH = layoutHeadH + layoutBodyH + layoutFootH,
             windowH = $(window).outerHeight(true),
             windowW = $(window).outerWidth(true),
             windowScrollH = layoutH - windowH,
             windowScrollT = $(window).scrollTop(),
             switchTop = (windowW < 768) ? 66 : 90,
             switchOpacity = windowScrollT - ((windowW < 768) ? 66 : 90),
             shouldBeFixed = windowScrollT >= switchTop ? true : false,
             isFixed = $('.layout').hasClass('fixed'),
             sectionHomeTitleH = $('.section-home-title').outerHeight(true);
         
             if (windowScrollH > 0) {
         
                 $('.layout').removeClass('static');
         
                 if (shouldBeFixed) {
         
                     if (!isFixed) {
                         $('.layout').addClass('fixed');
                     }
         
                     /*if (switchOpacity < 0) {
                         switchOpacity = 0;
                     }
                     if (switchOpacity > 95) {
                         switchOpacity = 95;
                     }
         
                     $('.layout-head').css('opacity', switchOpacity/100);
                     */
                 } else {
         
                     if (isFixed) {
                         $('.layout').removeClass('fixed');
                     }
         
                     $('.layout-head').css('opacity', 1);
         
                 }
         
             } else {
         
                 $('.layout').addClass('static');
         
                 if (isFixed) {
                     $('.layout').removeClass('fixed');
                 }
         
             }
         
         };
         
         $(document).ready(function() {
         
             // library
             Library.Shell.Dialog.construct({
                 svgPath: '{{asset('assets/fronts/src/img/sprite.svg')}}',
             });
         
             Library.Shell.Form.construct({
                 svgPath: '{{asset('assets/fronts/src/img/sprite.svg')}}',
                 textline: true,
                 textarea: true,
                 select: true,
                 checkbox: true,
                 radiobox: true,
                 button: true,
                 file: true,
                 placeholder: true
             });
         
             Library.Core.Form.construct({
                 placeholder: 'form-placeholder',
                 onalert: function(container, status, content) {
         
                     $(container).find('.alert .info').html(content);
         
                     $(container).find('.alert .icon svg').replaceWith(
                         '<svg>' +
                             '<use xlink:href=".assets/fronts/src/img/sprite.svg#micon_' + status + '">' +
                         '</svg>'
                     );
         
                     $(container).find('.alert')
                         .removeClass('success')
                         .removeClass('info')
                         .removeClass('error')
                         .addClass(status)
                         .show();
         
                 }
             });
         
             Library.Shell.Toogler.construct();
         
         
             // head nav menu
             Library.Shell.Toogler.register({
                 picker: '.layout-head .nav-menu > li:first-child a',
                 target: '.layout-head .nav-menu > li:first-child',
                 toogle: 'active',
                 ontoogle: function(status, caller) {
         
                     return true;
         
                 }
             });
         
         
             // head mobile menu
             Library.Shell.Toogler.register({
                 picker: '.layout-head .mobile-menu .picker',
                 target: 'body',
                 toogle: 'swapped',
                 ontoogle: function(status, caller) {
         
                     if (status == 'add') {
                         $('.layout-head .mobile-menu .drop').focus();
                     }
         
                     return true;
                 }
             });
         
             $('.layout-head .mobile-menu .drop .close').on('click', function() {
                 $('body').removeClass('swapped');
             });
         
             var fixHeaderMobileMenuHeight = function() {
         
                 var
                 navTop = parseInt($('.layout-head .mobile-menu .drop').css('top')),
                 bodyHeight = $('body').height();
         
                 //$('.layout-head .mobile-menu .drop').css('height', bodyHeight - navTop + 'px');
         
             };
         
             $(window).on('resize', function() {
                 fixHeaderMobileMenuHeight();
             });
         
             fixHeaderMobileMenuHeight();
         
             Library.Shell.Toogler.register({
                 picker: '.layout-head .mobile-menu .parent > a',
                 target: '.layout-head .mobile-menu .parent',
                 toogle: 'opened',
                 ontoogle: function(status, caller) {
                     if (caller == 'picker') {
                         return true;
                     }
                 }
             });
         
             // disable scrolling when menu is opened
             $(window).on('touchmove', function(event) {
                 if ($('body').hasClass('swapped')) {
                     if (!$(event.target).parents('.drop').size()) {
                         event.preventDefault();
                     } else {
                         if ($('.mobile-menu .drop-content').height() < $('.mobile-menu .drop').height()) {
                             event.preventDefault();
                         }
                     }
                 }
             });
         
         
             // fix page
             fixPage('init');
         
             $(window).scroll(function(event) {
                 fixPage('scroll');
             });
         
             $(window).on('resize', function(event) {
                 fixPage('resize');
             });
         
             $(window).on('wheel mousewheel', function(event) {
                 fixPage('scroll');
             });
         
         
             // arrow scroll
             $('.section-home-features .arrow').on('click', function() {
                 $('html, body').animate({
                     scrollTop: $('.section-home-features .arrow').offset().top
                 }, 500);
             });
         
         });
         
         $(window).load(function() {
         
             // fix page
             fixPage('resize');
         
             $('.block-welcome .status.process').addClass('rotating');
         
             setTimeout(function() {
         
                 $('.block-welcome .status.process').removeClass('rotating');
                 $('.block-welcome .status.process').css('opacity', 0);
                 $('.block-welcome .status.done').css('opacity', 1);
         
                 setTimeout(function() {
         
                     $('.section-home-title .form-button').addClass('bigger');
         
                     setTimeout(function() {
                         $('.section-home-title .form-button').addClass('normal');
                     }, 0.5 * 1000);
         
                 }, 0.5 * 1000);
         
             }, 1 * 1000);
         
         });
         
      </script>