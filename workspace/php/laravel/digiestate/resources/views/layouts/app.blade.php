<!DOCTYPE html>
<html>
   <head profile="http://www.w3.org/2005/10/profile">
       <title> @yield('title')</title>
     <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="noodp,noydir" />
    <link rel="sitemap" href="http://digiestate.in/sitemap.xml" type="application/xml" />
       
     @include('includes.fronthead') 
   </head>
   <body class="common home">
      <div class="layout">
         
         @include('includes.frontheader')
         @yield('content')
         
         @include('includes.frontfooter')
         
          
        
      </div>
      @include('includes.social')
     @yield('extrajs')
   </body>
</html>