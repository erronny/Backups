@extends('layouts.master')


@section('content')
<div class="basic-form-area mg-tb-15">
 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                  <div class="form-group">
                                      <div class="col-sm-6"><h1>{{$page_title}}</h1></div>
                                      <div class="col-sm-6 text text-right">
                                        <a class="btn btn-primary" href="{{ URL("admin/courier")}}" title="Courier Partner List"><span class="fa fa-list"></span>&nbsp;List</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">
                                                {{-- <form action="#"> --}}


                                        @if(Request::segment(4)==='edit')
                                        {{ Form::model($coriour, array('route' => array('courier.update', $coriour->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
                                        <?php  
                                            $name= $coriour->name;
                                            $mobile= $coriour->mobile;
                                            $email= $coriour->email;
                                            $fax= $coriour->fax;
                                            $address= $coriour->address;
                                            $logo= $coriour->logo;
                                        ?>
                                        @else
                                        {{ Form::open(array('url' => 'admin/courier','enctype'=>'multipart/form-data')) }}

                                        <?php 
                                            
                                            $name= "";
                                            $mobile= "";
                                            $email= "";
                                            $logo= "";
                                            $address= "";
                                            $logo= "";
                                            $fax= "";
                                    
                                        ?>
                                        @endif



                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Category Name</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" class="form-control" name="name"  value="{{old('name')?old('name'):$name}}"  placeholder="Category Name" />
                                                                 @if($errors->has('name'))
                                                                  <div class="text text-danger">{{ $errors->first('name') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                   

                                                 
                                                    <div class="form-group form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Logo </label>
                                                            </div>
                                                             <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro"> 
                                                                    <?php
                                                                        if($logo){
                                                                            $url = "assets/img/courier/".$logo;
                                                                        }else{
                                                                            $url = "assets/gallery.png";
                                                                        }
                                                                    ?>

                                                                    <img style="width: 50%;" src="{{asset($url)}}" id="imagePreview"> </label>
                                                            </div>
                                                           
                                                            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                                                                <input id="image" type="file" name="file">
                                                            </div>
                                                        </div>
                                                    </div>


                                                
               
                                                    <div class="form-group-inner">
                                                        <div class="login-btn-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3"></div>
                                                                <div class="col-lg-9">
                                                                    <div class="login-horizental cancel-wp pull-left">
                                                                        <button class="btn btn-white" type="submit">Cancel</button>
                                                                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Save Change</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
      <script type="text/javascript">
        
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#imagePreview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#image").change(function() {
  readURL(this);
});
      </script>
@endsection