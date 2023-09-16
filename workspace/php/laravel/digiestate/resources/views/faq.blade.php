@extends('layouts.app')
@section('title', 'faq')

@section('description', 'Digiestate makes cloud photo storage secure, offers best services for professional photographers and secures data. For more details visit the website now!')
@section('keywords', 'Digiestate makes cloud photo storage secure, offers best services for professional photographers and secures data. For more details visit the website now!')

@section('content')
 <div class="layout-body">
            <div class="page page-home">
               <div class="section-home-apps">
                  <div>
                     <h2>FAQ</h2>
                     
                    <div class="container-fluid">
                       <div class="row">
                        <div class="col-sm-12">
                        <ul><h3>   1.	What is Digiestate ?</h3></ul>
          <ul>Digiestate provides you a secure cloud storage space where you can where you can store, access, share and backup all of your data as photos, documents and Data Back up which helps you to protect your data.</ul>

 <ul><h3>2.	Why use Digiestate ?</h3></ul>
      <ul>  Digiestate is the only online cloud storage app where you can store, access, share and backup all of your data as photos, documents and Data Back up also one feature where you can share your storage data with your family and friends. All the apps in the market provides similar features but no apps provide storage sharing feature.also, with Digiestate you'll be able to easily manage your images, contacts and dataall in one secure app.
</ul>
 <ul><h3>3.	What types of files can I upload to my Digiestate account?</h3></ul>
         <ul>Digiestate currently helps you to upload JPG and PDF file on your account. With updated version we will come up with more file type uploading. If you have enough space on your account you may store and share any file type and size.
</ul>
 <ul><h3>4.	Who can I share my files with?</h3></ul>
         <ul> Digiestate gives you full access to your all the docs and files so that you can share all your files and folder with anyone to whom you want to share , also you can share the files and folders on Whatsapp and Skype as well after downloading however if you want to share the data faster then any other medium then we suggest to use Digiestate app to Digiestate app very easy and faster .
</ul>
 <ul><h3>5.	What pricing/planes you offer for storage?</h3></ul>
     <ul> Our pricing and plans are very affordable, for more details please go through with our Pricing column.
</ul>
 <ul><h3>6.	How secure our data in Digiestate?</h3></ul>
     <ul>Digiestate use end to end encryption and our servers are secure so that no unauthorized access can be possible.
</ul>
 <ul><h3>7.	How can we contact support in case of any questions and queries?</h3></ul>
          <ul> If anyone have any questions and queries, please visit contact us and leave message to us.
</ul>
 <ul><h3>8.	How can I register myself to Digiestate ?</h3></ul>
        <ul> With Digiestate app from Google Play store you can register with us and also you can use the service of Web Version from same User I'd and password.</ul>

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
    