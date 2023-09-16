@extends('layouts.master')


@section('content')
<div class="data-table-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    
                                    <div class="col-sm-6"><h1>{{$page_title}}</span></h1></div>
                                    <div class="col-sm-6 text text-right">
                                      <a class="btn btn-primary" href="{{ URL("admin/courier/create")}}"><span class="fa fa-plus"></span>&nbsp;Add</a>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                 
                                   <table id="myTable" class="table" style="width: 100%;">
                                <tr>
                                    <th width="10%">Image</th>
                                    <th width="40%">Name</th>
                                    <th width="10%">Status</th>
                                    <th width="40%">Action</th>
                                </tr>

                                @foreach($couriers as $key=>$courier)
                                <tr>
                                    <td style="width: 10%">
                                        <?php
                                            $url="assets/gallery.png";
                                            if($courier->logo){
                                                $url="assets/img/category/".$courier->logo;
                                            }
                                        ?>
                                        <img class="img-circle" src="{{ asset($url)}}" alt="" />
                                    </td>
                                    <td>{{$courier->name}}</td>
                                    <td>
                                        @if($courier->IsActive)
                                            <span class="text text-success fa fa-check"></span>
                                        @else
                                            <span class="text text-danger fa fa-remove"></span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('courier.edit',$courier->id)}}" class="btn btn-info pull-left" style="margin-right: 3px;" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>

                                        {{ Form::open(['method' => 'DELETE', 'route' => ['courier.destroy', $courier->id] ]) }}
                  
                                            <button type="submit" class="btn btn-danger pull-left" title="Delete" onclick="return confirm('Do You want to Delete?')"><i class="fa fa-trash"></i></button>
                                        {{ Form::close() }}
                 
                <?php if($courier->IsActive){ ?>
                <a href="{{ URL::to('admin/updateDocument/'.$courier->id.'/deactive') }}" class="btn btn-warning pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Dctivated?')" title="Click to Deactive"><i class="fa fa-eye-slash"></i></a>
                   <?php }else{ ?>
                <a href="{{ URL::to('admin/updateDocument/'.$courier->id.'/active') }}" class="btn btn-success pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Activated?')" title="Click to Active"><i class="fa fa-eye"></i></a>
                   <?php } ?>

                                       
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

<script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<style type="text/css" href="{{asset('assets/css/jquery.dataTables.min.css')}}"></style>

{{-- 
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 --}}
<script type="text/javascript">
$(document).ready( function () {
    $('#myTable').DataTable({
        "lengthMenu": [[25, 50, 100, 500, 1000],[25, 50, 100, 500, "Max"]],
        "pageLength": '500',
    });
} );

</script>

@endsection