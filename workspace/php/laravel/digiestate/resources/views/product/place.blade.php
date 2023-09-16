@extends('layouts.master')
@section('content')

<style>
.glyphicon { margin-right:5px; }
.thumbnail
{
    margin-bottom: 20px;
    padding: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
}

.item.list-group-item
{
    float: none;
    width: 100%;
    background-color: #fff;
    margin-bottom: 10px;
}
.item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
{
    background: #428bca;
}

.item.list-group-item .list-group-image
{
    margin-right: 10px;
}
.item.list-group-item .thumbnail
{
    margin-bottom: 0px;
}
.item.list-group-item .caption
{
    padding: 9px 9px 0px 9px;
}
.item.list-group-item:nth-of-type(odd)
{
    background: #eeeeee;
}

.item.list-group-item:before, .item.list-group-item:after
{
    display: table;
    content: " ";
}

.item.list-group-item img
{
    float: left;
     width: 35%;
}
.item.list-group-item .topright
{
   
     width: 34.1%;
}
.item.list-group-item:after
{
    clear: both;
}
.list-group-item-text
{
    margin: 0 0 11px;
}
.topright {
    top: 0px;
    right: 16px;
    font-size: 18px;
    background: #b71707;
    width: 92%;
    position: absolute;
    left: 16px;
    color: white;
    
}
</style>
<div class="data-table-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="text text-success" id="cartMessage" style="padding: 10px 10px 10px 50px; color: green; font-size: 16px;"></div> 
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text text-right">
                      <!-- <a href="{{URL('admin/cart')}}">
                        <span id="cortCount" style="background: #a94242;border-radius: 50px;padding: 5px;color: #fff;">{{ $count }}</span>
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a> -->

                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     
                      <div class="">
                          <div class="well well-sm" style="min-height: 50px;">
                              
                              <div class="btn-group col-lg-3 col-md-3 col-sm-3 col-xs-3" style="float: left;">
                                  <a href="#" id="list" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-th-list"></span>List
                                  </a> 
                                  <a href="#" id="grid" class="btn btn-default btn-sm ">
                                    <span class="glyphicon glyphicon-th"></span>Grid
                                    </a>
                              </div>
                              <div style="float: right;" class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                               <form>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                  <input type="text" name="keywords" class="form-control" placeholder="Enter keywords for search product" value="<?php  if(isset($_GET['keywords'])){ echo $_GET['keywords'];}?>">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                 <select class="form-control" name="sort">
                                    <option value="all">All</option>
                                    <option value="id" <?php  if(isset($_GET['sort'])){ if($_GET['sort']=='id'){echo 'selected';}}?>>Newest First</option>
                                    <option value="asc" <?php  if(isset($_GET['sort'])){ if($_GET['sort']=='asc'){echo 'selected';}}?>>Price-- Low to High</option>
                                    <option value="desc" <?php  if(isset($_GET['sort'])){ if($_GET['sort']=='desc'){echo 'selected';}}?>>Price-- High to Low</option>
                                  </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                   <input type="submit" value="Search" class="btn btn-success">
                                    <a href="{{URL('/admin/place_order')}}"  class="btn btn-danger">Reset</a>
                                </div>
                               </form>
                              </div>
                          </div>
                            <div id="products" class="row list-group">

                                @php $count = 1; @endphp
                                @if(isset($products) && !empty($products))
                                @foreach ($products as $product)  
                                <?php
                                $class="";
                                if(\Cart::get($product->id)){
                                $class ="alert alert-danger";
                                } 
                                $image = "assets/gallery.png";
                                if($product->defaultImage->url){
                                    $image = "assets/img/product/".$product->defaultImage->url;
                                }
                                        ?>
                                      <div class="item  col-xs-4 col-lg-4">
                                        <?php if(\Cart::get($product->id)){ ?>
                                         <div class="topright">
                                            <h3 style="font-size: 16px;float: left;padding: 5px">Product already added in cart.</h3>
                                          <i class="fa fa-check-circle" style="color: #fff;text-align: right;float: right;    padding: 5px;" aria-hidden="true"></i>
                                        </div> <?php } ?>
                                          <div class="thumbnail">
                                              <img class="group list-group-image" src="{{ asset($image)}}" alt="" style="height: 270px;" />
                                              <div class="caption">
                                                  <h4 class="group inner list-group-item-heading">
                                                    <a href="{{URL('admin/updateDetail/'.$product->id)}}"> {{$product->name}}</a></h4>
                                                  <p class="group inner list-group-item-text">
                                                     {{$product->short_des}}</p>
                                                  <div class="row">
                                                      <div class="col-xs-12 col-md-6">
                                                          <p class="lead">
                                                              ${{$product->selling_price}}</p>
                                                      </div>
                                                     <div class="col-xs-12 col-md-6">
                                                        <?php if($product->current_stock>0){ ?>
                                                        <a class="btn btn-success addToCart" style="margin-right: 3px;" pid="{{$product->id}}"  title="Add To Cart"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a>
                                                    <?php } else {
                                                     echo '<div style="width: 100%;left:-15px" class="topright">
                                                           <h3 style="font-size: 16px;float: left;padding: 5px;width: 100%;">Product Out Of Stock.</h3>
                                                               </div> ';} ?>
                                                          
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>

                                   @endforeach
                                   @endif
        
                            </div>
                       </div>
                           <?php 
                               if(isset($_GET['keywords']))
                               {
                               ?>
                                 {{ $products->appends(['keywords' => $_GET['keywords']])->links() }}
                              <?php  }
                             else
                             {
                              ?>
                             {{ $products->links() }}
                            <?php } ?>
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
        

        <div id="imageShow">
        
        </div>


      </div>
      <div class="modal-footer">
           <button class="btn btn-default" id="updateDefault" >Update</button>
      </div>
    </div>

  </div>
</div>

@endsection
@section('extrajs')
<style type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<script type="text/javascript">
$(document).ready( function () {
    $('#myTable').DataTable({
      "lengthMenu": [[25, 50, 100, 500, 1000],[25, 50, 100, 500, "Max"]],
      "pageLength": '500',
    });
});

$('#updateDefault').click(function(){
    var id = ($("input[name=image]:checked").val());

    var _token = "{{ csrf_token() }}";
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
            window.location.reload();
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
 // $.ajax({url: "demo_test.txt", success: function(result){
 //      $("#div1").html(result);
 // }});


// var _token = "{{ csrf_token() }}";
//     if(true){
//       $.ajax({
//         type: "POST",
//         url: "{{ URL('admin/repushStatus') }}",
//         data:{_token:_token,status:status,id:id},
//         beforeSend(xhr){
//             //alert('before');
//         },
//         success: function(result){
//           console.log(result);
//           var obj = JSON.parse(result);
//           if(obj.status == "success"){
//             console.log(obj.data);
//             console.log(obj.data[0].advertise.location.deviceId);
//             $('#example').DataTable().ajax.reload();
//           }
//           if(obj.status == "failed"){
//             alert(obj.message);
//           }
//              //console.log(result);
//         },error: function(data){
//                 //alert("error");
//         },complete: function(){
//                 //alert('complete');
//         } 
//       }); 
//   } 
</script>

@endsection