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
                                      <a class="btn btn-primary" href="{{ URL("admin/document")}}">List</a>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">
                                                

                                        @if(Request::segment(4)==='edit')
                                        {{ Form::model($product, array('route' => array('document.update', $product->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
                                        <?php  
                                            $cat= $product->category_id;
                                            $title= $product->name;
                                            $short_des= $product->short_des;
                                         ?>
                                        @else
                                        {{ Form::open(array('url' => 'admin/document','enctype'=>'multipart/form-data')) }}

                                        <?php 
                                            
                                            $cat= "";
                                            $title= "";
                                            $short_des= "";
                                            $image= "";
                                         
                                        ?>
                                        @endif

                                                   <div class="form-group-inner" style="display:none">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Category</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                               <select class="form-control" name="category" id="category">
                                                                 <option>Select Category</option>
                                                                 @foreach($categories as $key=>$category)
                                                                 <option value="{{$category->id}}" <?php if($cat == $category->id){ echo "selected"; } ?>>{{$category->name}}</option>
                                                                 @endforeach
                                                               </select>
                                                                @if($errors->has('category'))
                                                                  <div class="text text-danger">{{ $errors->first('category') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Document Title</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" class="form-control" name="title" value="{{old('title')?old('title'):$title}}" placeholder="Enter Title" />
                                                                @if($errors->has('title'))
                                                                  <div class="text text-danger">{{ $errors->first('title') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Image </label>
                                                            </div>
                                                             <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro"> <img style="width: 50%;" src="{{asset('assets/gallery.png')}}" id="imagePreview"> </label>
                                                            </div>
                                                           
                                                            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                                                                <input type="file" id="files" name="file[]" multiple="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(Request::segment(4)==='edit')
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                          <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                              <label class="login2 pull-right pull-right-pro"></label>
                                                          </div>
@if(!empty($product->image))
  @foreach($product->image as $k=>$value)
    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
      <div class="text text-left">
         @if($value->IsDefault)
          <i class="fa fa-check text text-success"></i>
        @else
          <i class="fa fa-remove text text-danger"></i>
        @endif
      </div>
      <div>
        <input type="text" class="form-control" name="doc_title[]" value="<?= $value->doc_name?$value->doc_name:''; ?>" placeholder="Enter Title">
        <input type="hidden" class="form-control" name="dids[]" value="<?= $value->id; ?>" placeholder="Enter Title">
      </div>

      @if($value->url)
        @php 
          $url = $value->url;
          $arr = explode('.', $value->url);
          $ext = $arr[1];
        @endphp
        @if($ext =='jpg' || $ext =='JPG' || $ext =='jpeg' || $ext =='JPEG' || $ext =='png' || $ext =='PNG')
          {{-- <span>Image File</span> --}}
          <img style="width: 150px;" class="document-size" src="{{asset('assets/img/documents/'.$value->url)}}">
        @elseif($ext =='pdf' || $ext =='PDF')
          <span><img class="imageThumb" src="http://digiestate.in/assets/pdf.png"/></span>
          <embed class="document-size" src="{{asset('assets/img/documents/'.$value->url)}}" type="application/pdf" />
        @elseif($ext =='doc' || $ext =='docx')
          <span><img class="imageThumb" src="http://digiestate.in/assets/doc.png"/></span><br/>
          <a target="_blank" href="{{asset('assets/img/documents/'.$value->url)}}" class="btn btn-warning">Download</a>
        @elseif($ext =='xls' || $ext =='xlsx' || $ext =='csv')
          <span><img class="imageThumb" src="http://digiestate.in/assets/excel.png"/></span><br/>
          <a target="_blank" href="{{asset('assets/img/documents/'.$value->url)}}" class="btn btn-warning">Download</a>
        @endif
      @else
        <span>No File</span>
      @endif
                                                                
    </div>
  @endforeach
@endif
                                                            
                                                            {{-- <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                                                <img style="width: 50%;" src="{{asset('assets/gallery.png')}}" id="imagePreview">
                                                            </div>

                                                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                                                <img style="width: 50%;" src="{{asset('assets/gallery.png')}}" id="imagePreview">
                                                            </div>

                                                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                                                <img style="width: 50%;" src="{{asset('assets/gallery.png')}}" id="imagePreview">
                                                            </div> --}}

                                                        </div>
                                                    </div>
                                                    @endif

                                                      <div class="form-group-inner" style="display:none">
                                                    <div class="row">
                                                      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                      <label class="login2 pull-right pull-right-pro">Short Description</label>
                                                      </div>
                                                      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <textarea placeholder="Short Description" name="short_des" class="form-control">{{old('short_des')?old('short_des'):$short_des}}</textarea>
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
<style>
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style>
 <link rel="stylesheet" href="{{ asset('assets/css/form/all-type-forms.css')}}">
 <link rel="stylesheet" href="{{ asset('assets/css/summernote/summernote.css')}}  ">
    <script src="{{ asset('assets/js/summernote/summernote.min.js')}}"></script>
    <script src="{{ asset('assets/js/summernote/summernote-active.js')}}"></script>
      <script type="text/javascript">



$(document).ready(function() {
  
  if (window.File && window.FileList && window.FileReader) {

    $("#files").on("change", function(e) {
      var extArr = [];
      // console.log("change");
      var files = e.target.files,
      filesLength = files.length;
    
      for (var i = 0; i < filesLength; i++) {

        var f = files[i]

        
        var url = f.name;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        extArr.push(ext);
        console.log('file ext outside',i+' : '+ext);
        var fileReader = new FileReader();
        var j =0;
        fileReader.onload = (function(e) {
          
          
          console.log('file ext inside',i+' : '+ext);
          var file = e.target;
          var ext = extArr[j];
          j++;
          console.log("counter",ext);
          if (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg") {
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove</span>" +
            "</span>").insertAfter("#files");
          }else if(ext == "csv" || ext == 'xls' || ext == 'xlsx'){ 
            $("<span class=\"pip\">" +
               "<img class=\"imageThumb\" src=\"http://digiestate.in/assets/excel.png\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove</span>" +
            "</span>").insertAfter("#files");
          }else if(ext == "doc" || ext == 'docx'){ 
            $("<span class=\"pip\">" +
               "<img class=\"imageThumb\" src=\"http://digiestate.in/assets/doc.png\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove</span>" +
            "</span>").insertAfter("#files");
          }else if(ext == "pdf"){ 
            $("<span class=\"pip\">" +
               "<img class=\"imageThumb\" src=\"http://digiestate.in/assets/pdf.png\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove</span>" +
            "</span>").insertAfter("#files");
          }else{
            $("<span class=\"pip\"> Other file" +
            "<br/><span class=\"remove\">Remove</span>" +
            "</span>").insertAfter("#files");
          }

          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});


  function readURL(input) {
  if (input.file && input.file[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      console.log('fff',e);
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