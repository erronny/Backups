@extends('layouts.master')


@section('content')
<div class="data-table-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div>
                                    @if(Session::has('message'))
                                    <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!}</div>
                                    @endif

                                    @if(Session::has('error'))
                                    <div class="alert alert-danger login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('error') !!} </div>
                                    @endif
                                    <div id="errorMeaageShow"></div>
                                </div>
                                <div class="main-sparkline13-hd">
                                    
                                    <div class="col-sm-6"><h1>User <span class="table-project-n">List</span></h1></div>
                                    <div class="col-sm-6 text text-right">
                                      {{-- <a class="btn btn-primary" title="Add" href="{{ URL("admin/users/create/")}}">Add</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                 
                                   <table id="myTable" class="table">
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Occupation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($users as $user)
                                
                                <tr>
                                    <td style="width: 10%">

                                         <?php $url = "assets/gallery.png"; ?>   
                                        <img class="img-circle" src="{{ asset($url)}}" alt="" /></td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>{{$user->mobile_no}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>{{$user->occupation}}</td>
                                    <td>
                                        @if($user->IsActive)
                                            <i class="text text-success fa fa-check" aria-hidden="true"></i>
                                        @else
                                            <i class="text text-danger fa fa-remove" aria-hidden="true"></i>
                                        @endif
                                    </td>
                                    <td>
                                         <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-edit"></i></a> 

                                            <?php if($user->IsActive){ ?>
                                                <a href="{{ URL::to('admin/updateUser/'.$user->id.'/deactive') }}" class="btn btn-danger pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Dctivated?')" title="Click to Deactive"><i class="fa fa-ban"></i></a>
                                                   <?php }else{ ?>
                                                <a href="{{ URL::to('admin/updateUser/'.$user->id.'/active') }}" class="btn btn-success pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Activated?')" title="Click to Active"><i class="fa fa-check"></i></a>
                                                   <?php } ?>

                                            {{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) }}
                                                <button type="submit" class="btn btn-danger pull-left" title="Delete" onclick="return confirm('Do You want to Delete?')"><i class="fa fa-trash"></i></button>
                                            {{ Form::close() }}
                                    </td>
                                </tr>

                                @endforeach

                            </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('extrajs')
<style type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<script type="text/javascript">
$(document).ready( function () {
    $('#myTable').DataTable({
      "lengthMenu": [[25, 50, 100, 500, 1000],[25, 50, 100, 500, "Max"]],
"pageLength": '500',
    });
} );

</script>

@endsection