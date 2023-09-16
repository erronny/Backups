@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <div class="btn-group pull-right">
          <ol class="breadcrumb hide-phone p-0 m-0">
            <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Content</li>
          </ol>
        </div>
        <h4 class="page-title"><i class="fa fa-key"></i> Content List
        </h4>
      </div>
    </div>
  </div>
  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  @if(Session::has('message'))
  <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
  @endif
  <!-- end page title end breadcrumb -->
  <div class="row">

    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-body">
          <h4 class="mt-0 header-title">Content List </h4><hr/>

          <div class="row">
            <div class="col-sm-2">
              <div class="list-group">
                 @foreach ($contents as $content)
                <a href="#" class="list-group-item list-group-item-action content" cid="{{$content->id}}">
                <i class="fa fa-film" ></i> {{ $content->conatent_name }}</a>
                @endforeach
              </div>
            </div>
            <div class="col-sm-10" id="list">
              
            </div>
          </div>
          
         
        </div>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!-- end row -->
</div>
<!-- end container -->

<div class="modal fade" id="assignPopUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Assign Form</h4>
      </div>
      <div class="modal-body">
        <form id="assignForm" onsubmit="return assignForm(this)">
        <div class="form-group">
          
          <select class="form-control" name="user_id" id="user_id">
             <option value="" selected="">Select User</option>
                  @foreach ($users as $user)
                     <option value="{{$user->id}}" @if(''==$user->id) selected @endif>{{$user->name}}</option> 
                  @endforeach
                    </select>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>

      </div>
    </div>
  </div>
</div>
<input type="hidden" name="content_id" id="content_id">

<div class="modal fade" id="remarkPopUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remark Form</h4>
      </div>
      <div class="modal-body">
        <form id="remarkForm" onsubmit="return remarkForm(this)">
        
        <div class="col-sm-12 form-group">
          <div class="row">
            <div class="col-sm-6">
              <label><strong>Start Date</strong>:name</label>
            </div>
            <div class="col-sm-6">
              <label><strong>Due Date</strong>:name</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label><strong>Status</strong>:name</label>
            </div>
            <div class="col-sm-6">
              <label><strong>Priority</strong>:name</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label><strong>Assigned To</strong>:name</label>
            </div>

            <div class="col-sm-6">
              <label><strong>Owner</strong>:name</label>
            </div>
          </div>
        </div>


        <div class="form-group">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>

      </div>
    </div>
  </div>
</div>

@endsection

@section('extrajs')
<style type="text/css">
  .comment{
    padding: 10px 20px;
    font-size: 12px;
    font-style: italic;
    font-weight: bold;
    border-bottom-style: ridge;
    border-radius: 15px;
  }
</style>
<script type="text/javascript">
  function assignPopUp(content_id,user_id){
    $('#content_id').val(content_id);
    $('#user_id').val(user_id);
    $('#assignPopUp').modal('show');
  }

  function remarkPopUp(content_id,user_id){
    $('#content_id').val(content_id);
    $('#comments').val($('#comment_'+content_id).html());
    $('#notes').val($('#notes_'+content_id).html());
    //alert();
    $('#remarkPopUp').modal('show');
  }
  function notesShow(){
    //alert($('#notes').val());
    $('#notes_section_value').show();
  }

  function dependancyShow(){
    //alert();
    $('#dependancy_section_value').show();
  }
  function save_data(operation){
   // alert(operation);
    var data = $('#'+operation).val();
    var content_id = $('#content_id').val();
    var _token = "{{ csrf_token() }}";
var r = confirm("Are You Sure?");
if (r == true) {
  txt = "You pressed OK!";
  

    $.ajax({
      url:"{{ URL('admin/update_content') }}"+'/'+operation,
      method:"POST",
      data:{'_token':_token,'content_id':content_id,'data':data},
      success: function(data) {
        //console.log(data);
        var obj = JSON.parse(data);
        if(obj.status == 'success'){
          if(operation =='notes'){
            var htm=' <div class="comment"><div>'+obj.results.notes+'</div><div class="text text-right">'+obj.results.created_at+'</div></div>';
          }

          if(operation =='dependancy'){
            var htm=' <div class="comment"><div>'+obj.results.dependancy+'</div><div class="text text-right">'+obj.results.created_at+'</div></div>';        
          }
          
          $('#'+operation+'_section_data').html(htm);
        }
        //$('#list').html(data);
      },
      error: function() {
         console.log('An error occurred');
      }
    });
    $('#'+operation+'_section_value').hide();
    }
     
  }
$('#list').on('keydown','.comment_text',function(e){

    if (e.keyCode == 13) {
      var that = this;
      var content_id = $('#content_id').val();
      var comment = ($(this).val());
      //console.log('enter press');
      var _token = "{{ csrf_token() }}";
      $.ajax({
        url:"{{ URL('admin/save_comment') }}",
        method:"POST",
        data:{'_token':_token,'content_id':content_id,'comment':comment},
        success: function(data) {
          //console.log(data);
          var obj = JSON.parse(data);
          if(obj.status == 'success'){
            //console.log(obj.comment);
            var htm=' <div class="comment"><div>'+obj.results.comment+'</div><div class="text text-right">'+obj.results.created_at+'</div></div>';
            $('#comment_section').append(htm);
            $(that).val('');
          }
          //$('#list').html(data);
        },
        error: function() {
          // $('#notification-bar').text('An error occurred');
        }
      });

    }
});
$('.content').click(function(){
  var cid = $(this).attr('cid');
  //alert(cid);

  $.ajax({
      url:"{{ URL('admin/get_content') }}"+'/'+cid,
      method:"GET",
    success: function(data) {
      //console.log(data);
      $('#list').html(data);
    },
    error: function() {
      // $('#notification-bar').text('An error occurred');
    }
    });
});
  function assignForm(obj){
    var _token = "{{ csrf_token() }}";
    var content_id = $('#content_id').val();
    var user_id = $('#user_id').val();
    $.ajax({
      url:"{{ URL('admin/user_assign') }}",
      method:"POST",
      data:{_token:_token,user_id:user_id,content_id:content_id},
    success: function(data) {
      console.log(data);
      var obj = JSON.parse(data);
      if(obj.status == 'success'){
        window.location.reload();
      }
      // $('#main').html($(data).find('#main *'));
      // $('#notification-bar').text('The page has been successfully loaded');
    },
    error: function() {
      // $('#notification-bar').text('An error occurred');
    }
    });
    return false;
  }

   function remarkForm(obj){
    var _token = "{{ csrf_token() }}";
    var content_id = $('#content_id').val();
    var formData = new FormData(obj);
    formData.append('content_id', content_id);
    formData.append('_token', _token);
    $.ajax({
      url:"{{ URL('admin/user_remark') }}",
      method:"POST",
      cache:false,
      contentType: false,
      processData: false,
      data:formData,
      success: function(data) {
        console.log(data);
        var obj = JSON.parse(data);
        if(obj.status == 'success'){
          window.location.reload();
        }
        // $('#main').html($(data).find('#main *'));
        // $('#notification-bar').text('The page has been successfully loaded');
      },
      error: function() {
        // $('#notification-bar').text('An error occurred');
    }
    });
    return false;
  }
</script>
@endsection