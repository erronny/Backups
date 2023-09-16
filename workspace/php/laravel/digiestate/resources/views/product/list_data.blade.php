@extends('layouts.master')
@section('content')

<div class="data-table-area mg-tb-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div>
                        @if(Session::has('message'))
                        <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
                        @endif

                        @if(Session::has('error'))
                        <div class="alert alert-danger login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('error') !!} </div>
                        @endif
                    </div>
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            
                            <div class="col-sm-6"><h1>{{$page_title}}</h1></div>
                            <div class="col-sm-6 text text-right">
                              {{-- <a class="btn btn-primary" href="{{ URL("admin/document/create")}}">Add</a> --}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-12">
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
                      </div>
                    </div>

                    <table class="table">
                      <thead>
                        <tr>
                          <th>SNO</th>
                          <th>Document</th>
                          <th>User</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($documents as $key=>$document)
                          <tr>
                            <td>{{($key+1)}}</td>
                            <td>
                              
                               @if($document->image && $document->image->url)
                                  @php 
                                    $url = $document->image->url;
                                    $arr = explode('.', $document->image->url);
                                    $ext = $arr[1];
                                  @endphp
                                  @if($ext =='jpg' || $ext =='JPG' || $ext =='jpeg' || $ext =='JPEG' || $ext =='png' || $ext =='PNG')
                                    {{-- <span>Image File</span> --}}
                                    <img style="width: 150px;" class="document-size" src="{{asset('assets/img/documents/'.$document->image->url)}}">
                                  @elseif($ext =='pdf' || $ext =='PDF')
                                    {{-- <span>Pdf File</span> --}}
                                     <embed class="document-size" src="{{asset('assets/img/documents/'.$document->image->url)}}" type="application/pdf" />
                                  @elseif($ext =='doc' || $ext =='docx')
                                    <span>Doc File</span><br/>
                                    <a target="_blank" href="{{asset('assets/img/documents/'.$document->image->url)}}" class="btn btn-warning">Download</a>
                                  @elseif($ext =='xls' || $ext =='xlsx' || $ext =='csv')
                                    <span>Excel File</span><br/>
                                    <a target="_blank" href="{{asset('assets/img/documents/'.$document->image->url)}}" class="btn btn-warning">Download</a>
                                  @endif
                                @else
                                  <span>No File</span>
                                @endif
                              
                              {{-- {{$document->image->url}} --}}
                            </td>
                            <td>
                              @if($type == 'share')
                                <span>{{$document->send_by?$document->send_by->name:'NA'}}</span>
                              @elseif($type == 'received')
                                <span>{{$document->received?$document->received->name:'NA'}}</span>
                              @endif
                              
                            </td>
                            <td>Action</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('extrajs')
@endsection