<!--Start Banner Section--->
<section class="bannersec">
  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
    <!-- Indicators -->
   
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      @php
       $count=1; 
      @endphp
      @if($slider)
       @foreach($slider as $val)
        <div class="item @if($count==1) active @endif">
              <ul class="itemUL">
                        <li class="itemcontent">
                          <div class="itemouterdiv">
                            <div class="itemcontentdiv">
                              <h2 class="bighead">{{$val->title}}<span>{{$val->subtitle}}</span></h2>
                              <p>{{$val->description}}</p>
                            </div>
                          </div>
                        </li>
                        <li class="itemimage">
                          @if($val->type=='image')
                              <div class="imgdiv_slider" style=" background-image: url('{{URL('/')}}/public/slider/{{$val->path}}');">
                              </div>
                           @else
                            <video autoplay muted loop id="myVideo">
                          <source src="{{URL('/')}}/public/slider/{{$val->path}}" type="video/mp4">
                          Your browser does not support HTML5 video.
                       </video>
                           @endif
                            
                        </li>
              </ul>
          </div>
        @php
        $count++; 
        @endphp
       @endforeach
      @endif
 
    </div>

    <!-- Left and right controls -->
  </div>
  <div class="carsolarrow"> 
    <a class="carousel-control arrowleft" role="button" href="#myCarousel" 
    data-slide="prev"><img src="{{URL('assets/frontend')}}/img/arrowleft.png"></a>
    <a class="carousel-control arrowright" role="button" href="#myCarousel" 
    data-slide="next"><img src="{{URL('assets/frontend')}}/img/arrowright.png"></a>   
  </div>
</section>
<!--End Banner Section--->