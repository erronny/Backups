@extends('layouts.master')


@section('content')
<div class="basic-form-area mg-tb-15">
 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <div class="col-sm-6"><h1>{{$page_title}}</h1></div>
                                    <div class="col-sm-6 text text-right">
                                      <a class="btn btn-primary" href="{{ URL("admin/document")}}">Back</a>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">
                                                

                                        

                                                   

                                                    

                                                 

@if(!empty($product->url))  
    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
      <div class="text-center">
                            
       
        {!! QrCode::size(300)->generate("Hello") !!}  
                   

        </div>
        <div class="form-group-inner">
                 <div class="login-btn-inner">
                  <div class="row">
                  <div class="col-lg-3"></div>
                <div class="col-lg-9">
                <div class="login-horizental cancel-wp pull-left">
                
                <a class="btn btn-sm btn-primary login-submit-cs" type="button" href="{{ asset('assets/img/qr/'.$product->id.'.svg') }}" download>Download</a>
                </div>
                </div>
                </div>
                </div>
                </div>


      
                                                                
    </div>
  
@endif
                                                            
                                                           

 </div>
</div>


                                                      

                                               
               
                 
                
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
   
@endsection
@section('extrajs')

 <link rel="stylesheet" href="{{ asset('assets/css/form/all-type-forms.css')}}">
 <link rel="stylesheet" href="{{ asset('assets/css/summernote/summernote.css')}}  ">
    <script src="{{ asset('assets/js/summernote/summernote.min.js')}}"></script>
    <script src="{{ asset('assets/js/summernote/summernote-active.js')}}"></script>
    
@endsection