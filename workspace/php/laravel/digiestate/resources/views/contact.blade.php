@extends('layouts.app')
@section('title', 'Best Cloud Photos Backup Storage by Digiestate')

@section('description', 'Digiestate makes cloud photo storage secure, offers best services for professional photographers and secures data. For more details visit the website now!.')
@section('keywords', 'cloud backup photos, best cloud storage for professional photographers, secure cloud storage for photos')

@section('content')
 <div class="layout-body">
            <div class="page page-home">
               <div class="section-home-apps">
                  <div>
                     <h2>Contact Us</h2>
                     
                     <div class="container-fluid">
                       <div class="row"> 

                       <div class="col-sm-3">
                                                    </div>
                        <div class="col-sm-6">
                               <!--<div >-->
                                 
                               <!--<label style="color: #35a0fc" >Call Us : +91 7554930332</label>-->
                               <!--   </div>-->
                               <label style="color:#35a0fc" >Email : digiestate.in@gmail.com</label>
                           <div class="form-group">
                             <label>Name</label>
                             <input type="text" required="" name="name" placeholder="Enter Name" class="form-control">
                           </div>
                           <div class="form-group">
                             <label>Email</label>
                             <input type="email" required="" name="email" placeholder="Enter Email" class="form-control">
                           </div>
                           <div class="form-group">
                             <label>Subject</label>
                             <input type="number" required="" name="subject" placeholder="Enter Subject" class="form-control">
                           </div>
                           <div class="form-group">
                             <label>Address</label>
                             <textarea name="address" placeholder="Enter Your Address" rows="3" class="form-control"></textarea>
                           </div>

                           <div class="form-group">
                             <button class="btn btn-primary">Submit</button>
                           </div>
                        </div>     <div class="col-sm-3">
                                                    </div>
                        <!--<div class="col-sm-6">-->
                        <!--    <div class="img-devices" style="position: initial;"></div>      -->
                        <!--</div>-->
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
    