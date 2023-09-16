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
                                    
                                    <div class="col-sm-6"><h1>User Wise <span class="table-project-n text text-danger">Report</span></h1></div>
                                    <div class="col-sm-6 text text-right">
                                      {{-- <a class="btn btn-primary" title="Add" href="{{ URL("admin/users/create/")}}">Add</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                 
                                   <table id="myTable" class="table">
                                <tr>
                                    <th>SNO</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>File Size</th>
                                    <th>Registration Date</th>
                                </tr>
                                @foreach($users as $k=>$user)
                                
                                <tr>
                                    <td style="width: 10%">{{($k+1)}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>{{$user->mobile_no}}</td>
                                    <td>
                                        @php
                                        $size = \App\DocumentDetail::where(['createdby'=>$user->id])->get()->sum("file_size") 
                                        @endphp
                                        {{ round( (($size)/1024),2).' KB'  }}
                                    </td>
                                     <td>{{$user->created_at}}</td>
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