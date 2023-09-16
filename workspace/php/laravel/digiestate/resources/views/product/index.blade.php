@extends('layouts.master')
@section('content')

<div class="data-table-area mg-tb-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div>
                        @if(Session::has('message'))
                        <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!}</div>
                        @endif

                        @if(Session::has('error'))
                        <div class="alert alert-danger login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('error') !!} </div>
                        @endif
                        <div id="errorMeaageShow"></div>
                    </div>
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            
                            <div class="col-sm-6"><h1>{{$page_title}}</h1></div>
                            <div class="col-sm-6 text text-right">
                              <a class="btn btn-primary" href="{{ URL("admin/document/create")}}">Add</a>
                            </div>
                        </div>
                    </div>

                    <form>
                            <div class="row form-group">
                                
                                <div class="col-sm-6">
                                    <label>Title </label>
                                    <input type="text" name="title" class="form-control" placeholder="Title" value="<?php if(isset($_REQUEST['title'])){ echo $_REQUEST['title']; } ?>">
                                </div>
                                <div class="col-sm-3" style="display:none">
                                    <label>Category</label>
                                    <select class="form-control" name="cat" id="cat">
                                        <option value="all" selected=""> ALL</option>
                                        @foreach($categories as $k=>$category)
                                        <option value="{{$category->id}}" <?php if(isset($_REQUEST['cat'])){ if($_REQUEST['cat']==$category->id){echo "selected";} } ?>>{{$category->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                               
                                <div class="col-sm-3">
                                    <label>Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="all" selected="" <?php if(isset($_REQUEST['status'])){ if($_REQUEST['status']=='all'){echo "selected";} } ?>>All</option>
                                        <option value="1" <?php if(isset($_REQUEST['status'])){ if($_REQUEST['status']=='1'){echo "selected";} } ?>>Active</option>
                                        <option value="0" <?php if(isset($_REQUEST['status'])){ if($_REQUEST['status']=='0'){echo "selected";} } ?>>Deactive</option>
                                    </select>
                                
                                </div>
                                <div class="col-sm-3" style="padding-top: 25px;">
                                    <a href="{{URL('admin/document')}}" title="Reset Filter" class="btn btn-primary">Reset</a>
                                    <button type="submit" class="btn btn-warning">Search</button>
                                </div>
                            </div>
                          
                    </form>
                    
                    {{-- <div class="section">    --}}
                        <!--<button class="link" panel="list">List</button> -->
                        {{-- <button class="link in " panel="grid">Grid</button>   --}}
                    {{-- </div> --}}

                    

                    <div id="dataSection">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        
        <div class="form-group-inner">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label>Select User for Share Document</label>
                    <select class="form-control select2" multiple="" id="shareUser">
                        <option>Select User</option>
                        @foreach($users as $key=>$user)
                        <option value="{{$user->id}}">{{$user->name.' ( '.$user->mobile_no.' )'}}</option>
                        @endforeach
                        {{-- <option value="two">Two</option> --}}
                    </select>
                </div>
                <div class="col-sm-12">
                    <button class="btn btn-primary" onclick="onClickShare()">Share</button>
                </div>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
{{-- <style type="text/css" href="{{asset('assets/css/jquery.dataTables.min.css')}}"></style>
<script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
 --}}

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

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
    .date{
            left: 81%;
    position: relative;
    }
    #delete{
        display:inline-block;
    }
        .section{
            padding: 10px;
        }
        .section button{
            background-color: rgba(15, 110, 191, 0.64);
            border: 1px solid #337ab7;
            color: #656161;
            border-radius: 8px;
            padding: 4px 15px;
        }
        .section .in{
            color:#fff;
        }
        .document-size{
            height: 200px;
            width: 200px;
        }
        .tab-section{
            display: none;
        }
        .active{
            display: block;
        }
</style>
<script type="text/javascript">
    var shareDataUserId = [];
    var shareItemId = [];
    var _token = "{{ csrf_token() }}";
    var token = "{{ csrf_token() }}";
    var title = "{{ isset($_REQUEST['title'])?$_REQUEST['title']:'' }}";
    var category    = "{{ isset($_REQUEST['category'])?$_REQUEST['category']:'' }}";
    var status    = "{{ isset($_REQUEST['status'])?$_REQUEST['status']:'' }}";
    loadItem();
    function loadItem(){
        $.ajax({
            // type: "POST",
            url: "{{URL('admin/loadItem')}}",
            data:{title:title},
            beforeSend(xhr){
                //alert('before');
                $('#overlay').show();
            },
            success: function(result){
                $('#dataSection').html(result);
            },error: function(data){
                //alert("error");
                $('#overlay').hide();
            },complete: function(){
                //alert('complete');
                $('#overlay').hide();
            } 
        });
    }

    function onClickDeleteItem(){
        var r =confirm('Are You Sure?');
        if(r){
            if(shareItemId.length > 0){
                console.log('process to delete');
                $.ajax({
                    type: "POST",
                    url: "{{URL('admin/deleteAllItem')}}",
                    data:{_token:_token,ids:shareItemId},
                    success: function(result){
                        console.log(result);
                        var data = JSON.parse(result);
                        if(data.status=='success'){
                            //window.location.reload();
                            loadItem();
                         // $('#errorMeaageShow').css('color','green');   
                         $('#errorMeaageShow').html('<div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '+data.message+'</div>');   
                         // $('#errorMeaageShow').fadeOut(15000); 
                         resetCheckbox();  
                        }
                        if(data.status=='failed'){
                         // $('#errorMeaageShow').css('color','red');   
                         $('#errorMeaageShow').html('<div class="alert alert-danger login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '+data.message+'</div>');   
                         // $('#errorMeaageShow').fadeOut(15000);   
                        }
                        // $("#imageShow").html(data.html);
                    }
                });
            }else{
                console.log('Please select Item new');
            }
        }
    }

    function onClickShare(){
        if(shareItemId.length > 0){
            if(shareDataUserId.length > 0){
                var r =confirm('Are You Sure?');
                if(r){
                    if(shareItemId.length > 0){
                        console.log('process to delete');
                        $.ajax({
                            type: "POST",
                            url: "{{URL('admin/shareAllItem')}}",
                            data:{_token:_token,ids:shareItemId,shareDataUserId:shareDataUserId},
                            success: function(result){
                                console.log(result);
                                var data = JSON.parse(result);
                                if(data.status=='success'){
                                    //window.location.reload();
                                    // loadItem();
                                    $('#errorMeaageShow').html('<div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '+data.message+'</div>');   
                                    // $('#errorMeaageShow').fadeOut(15000); 
                                    $('#myModal').modal('hide');
                                    resetCheckbox();
                                }
                                if(data.status=='failed'){
                                    $('#errorMeaageShow').html('<div class="alert alert-danger login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '+data.message+'</div>');   
                                    // $('#errorMeaageShow').fadeOut(15000);   
                                }
                                // $("#imageShow").html(data.html);
                            }
                        });
                    }else{
                        console.log('Please select Item new');
                    }
                }
            }else{
                console.log('Please select user');
            }
        }else{
            console.log('Please select Item');
        }
    }

    function resetCheckbox(){
        shareDataUserId = [];
        shareItemId = [];
        $('.all-document').each(function () {
            // this.checked = false;
            $(this).prop('checked',false);
        });
    }
    function itemSelected(id,flag){
        $('.item'+id).each(function () {
            // this.checked = true;
            if(flag){
                console.log($(this).val());
                shareItemId.push($(this).val());
            }else{
                console.log($(this).val());
                const index = shareItemId.indexOf($(this).val());
                if(index > -1)
                {
                    shareItemId.splice(index, 1);
                }
            }
            $(this).prop('checked',flag);
        });
        console.log('shareItemId list = ', shareItemId)
    }
    
    // single item selected
    $(document).on('change','.all-document',function(){
        console.log('all-document');
        if($(this).prop("checked")){
            shareItemId.push($(this).val());
        }else{
            const index = shareItemId.indexOf($(this).val());
            if(index > -1)
            {
                shareItemId.splice(index, 1);
            }
        }
        console.log('shareItemId', shareItemId);
    });
    $(document).on('click','.item-select',function(){
        var itemId = $(this).attr('did');
        console.log(itemId);
        console.log($(this).prop("checked"));
        itemSelected(itemId,$(this).prop("checked"));
    });
    function toggleTitle(){
        console.log('toggleTitle');
        resetCheckbox();
    }
    function isCheckUserExist(id){
        const index = shareDataUserId.indexOf(id);
        if(index > -1)
        {
            shareDataUserId.splice(index, 1);
        }else{
            shareDataUserId.push(id);
        }
        console.log(shareDataUserId);
    }
$(document).ready(function() {
    $('.select2').select2(
        { width: '100%' }
        ).on('select2:select', function (e) {
            var data = e.params.data.id;
            console.log(data);
            isCheckUserExist(e.params.data.id);
        }).on('select2:unselect', function (e) {
            // var data = e.params.data;
            console.log(e);
            isCheckUserExist(e.params.data.id);
        });
});

$(document).on('click','.link',function(){
        $('.link').removeClass('in');
        var id = $(this).attr('panel');
        $('.tab-section').removeClass('active');

        $(this).addClass('in');
        $("#"+id).addClass('active');
});
    // $('.link').click(function(){
        
    //     //alert();
    // })

$(document).ready( function () {
    $('#myTable').DataTable({
      "lengthMenu": [[25, 50, 100, 500, 1000],[25, 50, 100, 500, "Max"]],
      "pageLength": '500',
    });
});
//getRecord();
    function getRecord(){
        var table=$('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "lengthMenu": [[25, 50, 100, 500, 1000],[25, 50, 100, 500, "Max"]],
             "pageLength": '500',
            "ajax": {
              'url':"{{ URL('admin/getDocument') }}",
              "type": "POST",
              "data":{
                "_token":token,
                'title':title,
                'category':category,
                'status':status
          }
            }, "columns": [
                { "data": "image"},
                { "data": "name"},
                { "data": "category"},
                { "data": "des"},
                { "data": "status"},
                { "data": "action" },
            ]
        } ); 
    }    



$(document).on('click','#updateDefault',function(){
    var id = ($("input[name=image]:checked").val());

    
    if(true){
      $.ajax({
        type: "POST",
        url: "{{ URL('admin/updateImages') }}",
        data:{_token:_token,id:id},
        beforeSend(xhr){
            //alert('before');
        },
        success: function(result){
          console.log(result);
          var obj = JSON.parse(result);
          if(obj.status == "success"){
            $('#myModal').modal('hide');
            //window.location.reload();
            $('#example').DataTable().ajax.reload();
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
});


// $(document).on('click','.panel-tab',function(){
//     //$('#myModal').modal('show');
//     console.log('click',$(this).attr('tab-id'));
//     if($('#'+$(this).attr('tab-id')).hasClass('in')){
//         $('#'+$(this).attr('tab-id')).removeClass('in');
//     }else{
//         $('#'+$(this).attr('tab-id')).addClass('in');
//     }
// })
$(document).on('click','.shareDocument',function(){
    $('#myModal').modal('show');
    // $('#shareUser').val(0);
    $('#shareUser').val(null).trigger('change');
})

</script>

@endsection