@extends('layouts.app')
@section('title', 'Signup')

@section('description', 'Digiestate is best online data sharing affordable services. Share files pc to cloud for secure storage, data sharing, backup and collaborations online for small businesses company in Delhi')
@section('keywords', 'Online Secure Data Sharing in Cloud Computing | Digiestate ')


@section('content')
 <div class="layout-body">
            <div class="page page-home">
               <div class="section-home-apps">
                  <div>
                     <h2>Download & Register from Google Play Store and Enjoy Free space..!!</h2>
                     
                     <!--<div class="container-fluid">-->
                     <!--  <div class="row">-->
                     <!--   <div class="col-sm-12">-->
                     <!--      <div class="form-group">-->
                     <!--        <label>Post Story</label>-->
                     <!--        <textarea class="form-control" placeholder="Enter Your Story" rows="10"></textarea>-->
                     <!--      </div>-->
                      
                     <!--      <div class="form-group">-->
                     <!--        <button class="btn btn-primary">Submit</button>-->
                     <!--      </div>-->
                     <!--   </div>-->
                      
                     <!--  </div>-->
                     <!--</div>-->
                     
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
    