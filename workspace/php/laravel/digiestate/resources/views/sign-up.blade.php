@extends('layouts.app')
@section('title', 'Best Cloud Photos Backup Storage by Digiestate')

@section('description', 'Digiestate makes cloud photo storage secure, offers best services for professional photographers and secures data. For more details visit the website now!.')
@section('keywords', 'cloud backup photos, best cloud storage for professional photographers, secure cloud storage for photos')

@section('content')
<div class="layout-body">
            <div class="page page-home">
               <div class="section-home-apps">
                  <div>
                     <h2>Sign Up</h2>
                     
                     <div class="container-fluid">
                       <div class="row"> 

                       <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                               <div>
                                 
                               {{-- <label style="color: #35a0fc" >Call Us : +91 7554930332</label> --}}
                                  </div>
                               {{-- <label style="color:#35a0fc" >Email : digiestate.in@gmail.com</label> --}}
                            <div id="errorMessage" class="text text-danger"></div>   
                           <div id="userSection">
                             <div class="form-group" style="text-align:left;">
                               <label>Name<span class="text text-danger">&nbsp;*&nbsp;</span> <span class="text text-danger" id="nameError"></span></label>
                               <input type="text" required="" name="name" id="name" placeholder="Enter Name" class="form-control">
                             </div>
                             <div class="form-group" style="text-align:left;" >
                               <label>Email<span class="text text-danger">&nbsp;*&nbsp;</span><span class="text text-danger" id="emailError"></span></label>
                               <input type="email" required="" name="email" id="email" placeholder="Enter Email" class="form-control">
                              
                             </div>
                             <div class="form-group" style="text-align:left;">
                               <label>Mobile<span class="text text-danger">&nbsp;*&nbsp;</span><span class="text text-danger" id="mobileError"></span></label>
                               <input type="number" required="" name="mobile" id="mobile" placeholder="Enter Mobile" class="form-control">
                               
                             </div>
                             <div class="form-group" style="text-align:left;">
                               <label>Password<span class="text text-danger">&nbsp;*&nbsp;</span><span class="text text-danger" id="passwordError"></span></label>
                               <input type="password" required="" name="password" id="password" placeholder="Enter Password" class="form-control">
                               
                             </div>
                             <div class="form-group" style="text-align:left;">
                              <button type="button" onclick="signupForm()" class="btn btn-primary">Submit</button>
                              </div>
                           </div>

                           <div id="otpSection" style="display: none;">
                             <div class="form-group" style="text-align:left;">
                               <label>OTP<span class="text text-danger">&nbsp;*&nbsp;</span><span class="text text-danger" id="passwordError"></span></label>
                               <input type="text" required="" name="otp" id="otp" placeholder="Enter OTP" class="form-control">

                               
                             </div>
                             <div class="form-group" style="text-align:left;">
                             <button type="button" onclick="verifyOtp()" class="btn btn-primary">Verify OTP</button>
                             <button onclick="sendOtp()" id="resendBtn" style="display: none;" class="btn btn-warning">Resend</button>
                             
                           </div>
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

</div>

<div id="overlay" style="display: none;" >
<div class="spinner"></div>
<br/>
Loading...
</div>
@endsection

 

@section('extrajs')
<style type="text/css">
  .spinner {
        margin: 0 auto;
        height: 64px;
        width: 64px;
        animation: rotate 0.8s infinite linear;
        border: 5px solid firebrick;
        border-right-color: transparent;
        border-radius: 50%;
    }
    @keyframes rotate {
        0% {
        transform: rotate(0deg);
        }
        100% {
        transform: rotate(360deg);
        }
    }
    #overlay {
        background: #ffffff;
        color: #666666;
        position: fixed;
        height: 100%;
        width: 100%;
        z-index: 5000;
        top: 0;
        left: 0;
        float: left;
        text-align: center;
        padding-top: 25%;
        opacity: .80;
    }
</style>
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

<script type="text/javascript">
    var _token = "{{ csrf_token() }}";
    function validateEmail(email) {
      const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }
    function validateMobile(mobile) {
            var pattern = /^\d{10}$/;
            if (pattern.test(mobile)) {
                //alert("Your mobile number : "+mobile);
                return true;
            }
            //alert("It is not valid mobile number");
            return false;
    }
    function verifyOtp(){
      var mobile = $('#mobile').val();
      var otp = $('#otp').val();
      $.ajax({
        type: "POST",
        url: "{{URL('verifyOtp')}}",
        data:{_token:_token,mobile:mobile,otp:otp},
        beforeSend(xhr){
          //alert('before');
          $('#overlay').show();
          $('#resendBtn').hide();
        },
        success: function(result){
          console.log(result);
          var data = JSON.parse(result);
          console.log(data);
          if(data.success){
            console.log('process form');
            userRegisteration();
          }else{
             $('#errorMessage').html(data.message);
             $('#resendBtn').show();
          }
          // $('#dataSection').html(result);
        },error: function(data){
          //alert("error");
          $('#overlay').hide();
        },complete: function(){
          //alert('complete');
          $('#overlay').hide();
        } 
      });
    }
    function sendOtp(){
      var mobile = $('#mobile').val();
      if(mobile !=''){
        $.ajax({
          type: "POST",
          url: "{{URL('sendOtp')}}",
          data:{_token:_token,mobile:mobile},
          beforeSend(xhr){
            //alert('before');
            $('#overlay').show();
            $('#resendBtn').hide();
          },
          success: function(result){
            console.log(result);
            var data = JSON.parse(result);
            console.log(data);
            if(data.success){
              console.log('process form');
              
            }else{
               $('#errorMessage').html('OTP Send failed : Please try again')
            }
            // $('#dataSection').html(result);
          },error: function(data){
            //alert("error");
            $('#overlay').hide();
          },complete: function(){
            //alert('complete');
            $('#overlay').hide();
          } 
        });
      }
    }
    function userRegisteration(){
      var name = ($('#name').val()).trim();
      var email = ($('#email').val()).trim();
      var mobile = ($('#mobile').val()).trim();
      var password = $('#password').val();

      $.ajax({
        type: "POST",
        url: "{{URL('userRegister')}}",
        data:{_token:_token,email:email,mobile:mobile,name:name,password:password},
        beforeSend(xhr){
          //alert('before');
          // $('#overlay').show();
        },
        success: function(result){
          console.log(result);
          var data = JSON.parse(result);
          console.log(data);
          if(data.success){
            window.location.href = "{{URL('login')}}";
          }else{
            
          }
          // $('#dataSection').html(result);
        },error: function(data){
          //alert("error");
          // $('#overlay').hide();
        },complete: function(){
          //alert('complete');
          // $('#overlay').hide();
        } 
      });
    }

    function signupForm(){
      var name = ($('#name').val()).trim();
      var email = ($('#email').val()).trim();
      var mobile = ($('#mobile').val()).trim();
      var password = $('#password').val();
      var flag = true;
      $('#nameError').html('');
      $('#emailError').html('');
      $('#mobileError').html('');
      $('#passwordError').html('');
      if(name ==''){
        $('#nameError').html('This feild required');
        flag = false;
      }

      if(email ==''){
        $('#emailError').html('This feild required');
        flag = false;
      }else if(email !=''){
        if(validateEmail(email)){
          // flag = true;
          $('#emailError').html('');
        }else{
          $('#emailError').html('Invalid Email');
          flag = false;
        }
      } 
      if(mobile ==''){
        $('#mobileError').html('This feild required');
      }else if(mobile !=''){

         if (mobile.length>10 || mobile.length<10)
         {
              $('#mobileError').html('Mobile No. should be 10 digit');
              //alert("Mobile No. should be 10 digit");
              document.getElementById('mobile').focus();
              return false;
         }else if(validateMobile(mobile)){
          // flag = true;
          $('#mobileError').html('');
        }else{
          $('#mobileError').html('Invalid Mobile');
          document.getElementById('mobile').focus();
          flag = false;
        }
      }

      if(password ==''){
        $('#passwordError').html('This feild required');
        flag = false;
      }

      if(flag)
      {
        // console.log('form valid');
        $.ajax({
          type: "POST",
          url: "{{URL('checkEmail')}}",
          data:{_token:_token,email:email,mobile_no:mobile},
          beforeSend(xhr){
            //alert('before');
            $('#overlay').show();
            $('#resendBtn').hide();
          },
          success: function(result){
            console.log(result);
            var data = JSON.parse(result);
            console.log(data);
            if(data.success){
              console.log('process form');
              sendOtp();
              $('#otpSection').show();
              $('#userSection').hide();
            }else{
              console.log('false');
              if(data.code == 201){
                console.log('false 201');
                  if(data.error.email){
                    console.log('false email');
                    $('#emailError').html('This email already exist');
                  }
                  if(data.error.mobile){
                    console.log('mobile');
                    $('#mobileError').html('This mobile already exist');
                  }
              } 
            }
            // $('#dataSection').html(result);
          },error: function(data){
            //alert("error");
            $('#overlay').hide();
          },complete: function(){
            //alert('complete');
            $('#overlay').hide();
          } 
        });
        // $('#otpSection').show();
        // $('#userSection').hide();
      }else{
        console.log('form invalid');
      }


      

      // $.ajax({
      //   type: "POST",
      //   url: "{{URL('userRegisteration')}}",
      //   data:{_token:_token,name:name,email:email,mobile:mobile,password:password},
      //   beforeSend(xhr){
      //     //alert('before');
      //     $('#overlay').show();
      //   },
      //   success: function(result){
      //     $('#dataSection').html(result);
      //   },error: function(data){
      //     //alert("error");
      //     $('#overlay').hide();
      //   },complete: function(){
      //     //alert('complete');
      //     $('#overlay').hide();
      //   } 
    // });
    }
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

@endsection
    