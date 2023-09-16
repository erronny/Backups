<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
@include('includes.head')        
</head>


    <body>
        @include('includes.side_menu')        
        <!-- Loader -->
        <div class="all-content-wrapper">
        <!-- Navigation Bar-->
        @include('includes.header')
        <!-- End Navigation Bar-->
          @yield('content')
        </div>
        <!-- end wrapper -->


        <!-- Footer -->
        

<script type="text/javascript">
    const url='<?php echo URL('/'); ?>';
</script>
    <!-- jquery
        ============================================ -->
    <script src="{{ asset('assets/js/vendor/jquery-1.11.3.min.js') }}"></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- wow JS
        ============================================ -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- price-slider JS
        ============================================ -->
    <script src="{{ asset('assets/js/jquery-price-slider.js') }}"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
    <!-- owl.carousel JS
        ============================================ -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- sticky JS
        ============================================ -->
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="{{ asset('assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/mCustomScrollbar-active.js') }}"></script>
    <!-- metisMenu JS
        ============================================ -->
    <script src="{{ asset('assets/js/metisMenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/metisMenu/metisMenu-active.js') }}"></script>
    <!-- morrisjs JS
        ============================================ -->
    <script src="{{ asset('assets/js/morrisjs/raphael-min.js') }}"></script>
     <!-- calendar JS
        ============================================ -->
    <script src="{{ asset('assets/js/calendar/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/fullcalendar-active.js') }}"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- main JS
        ============================================ -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
     @if(Auth::user()->role_id == Config::get('constants.VENDOR') || Auth::user()->role_id == Config::get('constants.REPRASNTATIVE'))
    <!--  <script src="{{ asset('assets/js/morrisjs/morris.js') }}"></script>
     <script src="{{ asset('assets/js/morrisjs/morris-active.js') }}"></script>
   
     <script src="{{ asset('assets/js/sparkline/jquery.sparkline.min.js') }}"></script>
     <script src="{{ asset('assets/js/sparkline/jquery.charts-sparkline.js') }}"></script> -->
  
     @endif
    @include('includes.footer')

        @yield('extrajs')

        <script type="text/javascript">
            
$('.addToCart').click(function(){
    var id = $(this).attr('pid');
    var _token = "{{ csrf_token() }}";
    if(true){
      $.ajax({
        type: "POST",
        url: "{{ URL('admin/addToCart') }}",
        data:{_token:_token,id:id},
        beforeSend(xhr){
            //alert('before');
        },
        success: function(result){
          console.log(result);
          var obj = JSON.parse(result);
          if(obj.status == "success"){
          $('#cartMessage').html('  <div class="alert alert-success"><div class=""><div class="alert-icon" style="float: left"><i class="fa fa-check"></i></div><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-remove"></i></span></button><b>&nbsp;Success Alert:</b> '+obj.message+'</div></div>');

            $('#cortCount').html(obj.count);
            //window.location.reload();
          }
          if(obj.status == "failed"){
            alert(obj.message);
          }
             //console.log(result);
        },error: function(data){
                //alert("error");
        },complete: function(){
                //alert('complete');
        } 
      }); 
  } 

})
        </script>
    </body>

</html>