@extends('layouts.app')
@section('title', 'Pricing')

@section('description', 'Digiestate makes cloud photo storage secure, offers best services for professional photographers and secures data. For more details visit the website now!.')
@section('keywords', 'Digiestate makes cloud photo storage secure, offers best services for professional photographers and secures data. For more details visit the website now!')

@section('content')
 <div class="layout-body">
            <div class="page page-home">
               <div class="section-home-apps">
                  <div>
                     <h2>PRICING</h2>
                     
                    <div class="container-fluid">
                       <div class="row">
                        <div class="col-sm-12">
                       
<ul><h4>  Select your plan as per your convenience</h4> </ul>  
<ul><h4>  Basic Version (Upto- 3Gb space Free ) </h4> </ul>
<ul><h4>  Features:</h4> </ul>
<ul>Lifetime Validity</ul>
<ul>3GB Cloud Storage(Free) </ul>
<ul>Share Files and Folders (Upload & Download File Upto 10 MB)</ul>
<ul>Share Cloud storage Data with Family and Friends</ul>
<ul>Save documents, Images, Contacts bookmarks</ul>

<ul><h2>Coming Soon</h2></ul>
<h4> <ul>Pro Version (15 Gb space ) & Many More Services. </h4> </ul>
<h4> <ul>Rs. 499/- Yearly. </h4> </ul>
<h4> <ul>Features: </h4> </ul>
<ul>3GB – 15GB Cloud Storage(Free) </ul>
<ul>Share Files and Folders</ul>
<ul>Share Cloud storage Data with Family and Friends</ul>
<ul>Save documents, Images, Contacts bookmarks</ul>


                        </div>
                       
                       </div>
                     </div>
                     
                  </div>
               </div>
              
            </div>
            <script type="text/javascript">
               $(document).ready(function() {
               
                   $('.jcarousel').jcarousel({
                       wrap: 'circular'
                   }).jcarouselAutoscroll({
                       interval: 5000,
                       target: '+=1',
                       autostart: true
                   });
               
                   $('.testimonial-controls .back').on('click', function() {
                       $('.jcarousel').jcarousel('scroll', '-=1');
                   });
                   $('.testimonial-controls .forward').on('click', function() {
                       $('.jcarousel').jcarousel('scroll', '+=1');
                   });
               
                   var recalculateTestimonials = function() {
                       var windowW = $(window).width();
                       if (windowW < 768) {
                           $('.section-home-testimonials > div').css('max-width', windowW + 'px');
                           $('.testimonial-list li').css('width', windowW - 110 + 'px');
                       } else {
                           $('.section-home-testimonials > div').css('max-width', '');
                           $('.testimonial-list li').css('width', '');
                       }
                   };
               
                   $(window).resize(function() {
                       recalculateTestimonials();
                   });
               
                   recalculateTestimonials();
               
               });
               
            </script>
         </div>
@endsection

@section('extrajs')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
@endsection
    