@extends('layouts.app')
@section('title', 'ReturnPolicy')

@section('description', 'Digiestate is best online data sharing affordable services. Share files pc to cloud for secure storage, data sharing, backup and collaborations online for small businesses company in Delhi.')
@section('keywords', 'Online Secure Data Sharing in Cloud Computing | Digiestate ')

@section('content')
 <div class="layout-body">
            <div class="page page-home">
               <div class="section-home-apps">
                  <div>
                     <h2>Return Policy</h2>
                     <ul><h3>PLEASE READ THESE TERMS OF USE CAREFULLY BEFORE USING THIS SITE</h3></ul>
<ul><h3>1. DESCRIPTION OF SERVICE</h3></ul>
<ul>Digiestate offers the Services at its Website https://www.Digiestate.in. The Services are: </ul>
<ul><h4>1. Digiestate Paid Service</h4></ul>
<ul>You will be charged fees (the "Fees") for this service. This Digiestate service is here in after referred to as "Pro Version" or  "Paid Service".</ul>
<ul><h4>2. Digiestate Free Service</h4></ul>
<ul>You will not be charged any fees for this service. Initially we are providing 3 GB free space to new users as launching offer. This Digiestate service is hereinafter referred to as “Basic Account” or “Free Service”. </ul>
<ul>Digiestate provides space storage for each Service type mentioned above. Space is provided in megabytes (“MB”) and gigabytes (“GB”). For practical reasons, whenever space is mentioned in GB on the Digiestate website, 1 GB represents 1,000 MB of storage space. </ul>
<ul><h3>2. PAYMENT TERMS</h3></ul>
<ul>You will be charged Fees for the Paid Service, which you will pay to Digiestate by authorized Internet Banking/ Payment gateway. The Fees applicable for the Service are available at www.Digiestate.in and as published within the Service. Digiestate reserves the right to change the Fees or applicable charges and to enforce new charges at any time, upon thirty (30) days prior notice to you (which may be sent by email). </ul>
<ul><h4>a. Free Service</h4></ul>
<ul>If you registered for a Free Service and at a later time decide to upgrade your account Paid Service, you will immediately be charged applicable Fees, and your upgrade date will become Billing Date on your account</ul>
<ul>If account is upgraded on 29th, 30th, or 31st day of the month, Billing Date will be set as the 1st of the next month. </ul>
<ul><h4>b. Paid Service</h4></ul>
<ul>If you registered for Paid Service on 29th, 30th, or 31st day of the month, Billing Date will be set as the 1st of the next month. </ul>
<ul>Your Digiestate account will be considered delinquent if your paid service period is being expired. The Service may be suspended, archived or purged from system if account is delinquent for more than one billing cycle. Digiestate may impose a charge to restore archived data from delinquent accounts. </ul>
<ul>If you believe Digiestate has billed you incorrectly, you must contact Digiestate no later than 60 days after the closing date on the first billing statement in which the error or problem appeared, in order to receive an adjustment or credit. Inquiries should be directed to Digiestate's Customer Support department. </ul>
<ul><h3>3. CANCELLATION AND TERMINATION</h3></ul>
<ul>Digiestate, in its sole discretion, may terminate your password, account or use of the Service and remove and discard any Data within the Service if you fail to comply with this TOS. You may terminate your account upon notice to Digiestate at any time; however, you will not receive a refund of any portion of your fees paid to Digiestate. Upon termination of an account, your right to use such account and the Service immediately ceases. Digiestate shall have no obligation to maintain any Data stored in your account or to forward any Data to you or any third party. </ul>
<ul>Digiestate, in its sole discretion, may terminate your account if it determines that your account is using excessive bandwidth resources. In such event, Digiestate will notify you of its decision but will not be liable for showing proof of bandwidth usage since it is proprietary information. </ul>
<ul>Digiestate reserves the right to cancel the Service or to discontinue accounts for users who have Free Service accounts that have been inactive for more than one hundred and eighty (180) days. </ul>

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
    