@extends('layouts.master')

@section('title', 'Dashboard')

@section('description', 'Best cloud service providers in India offers affordable services. Brings cloud data sharing and storage facilities that secure data. For more details visit the website now!')
@section('keywords', 'Best cloud service providers in India offers affordable services. Brings cloud data sharing and storage facilities that secure data. For more details visit the website now!')

@section('content')


<div class="section-admin container-fluid" style="margin-top: 90px;">
<div class="container-fluid" style="    margin-bottom: 20px;padding: 0px 19px;">
    <div class="row">
        <div style="margin-left: 200px; height:280px; background-size: 80% 80%;
    background-repeat: no-repeat; background-image:url('{{asset('assets/dashboard.png')}}')"></div>
    </div>
</div>
    @if(Auth::user()->user_type == 0)
        <div class="row admin text-center ">
            <div class="col-md-12">
                <div class="row">
                    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn res-mg-t-15 bg-danger" style="background-color: #d5480f;">
                            <h4 class="text-left text-uppercase"><b>
                                <a style="color:#fff;" href="{{URL('admin/document?status=1')}}">Active Document</a></b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="col-xs-3 mar-bot-15 text-left">
                                    <label class="label bg-green">Total</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin" style="color:#fff;">{{ \App\Document::where(['IsActive'=>1])->count()}}</h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 78%;" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    </div> 

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn bg-primary res-mg-t-15" style="background-color: #ee8f03;">
                            <h4 class="text-left text-uppercase"><b><a style="color:#fff;" href="{{URL('admin/document?status=0')}}">Inactive Document</a></b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="col-xs-3 mar-bot-15 text-left">
                                    <label class="label bg-green">Total</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin" style="color:#fff;">{{ \App\Document::where(['IsActive'=>0])->count()}}</h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 78%;" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn bg-info res-mg-t-15" style="background-color: #0a7eb4;">
                            <h4 class="text-left text-uppercase"><b><a style="color:#fff;" href="{{URL('admin/document')}}">Total Document</a></b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="col-xs-3 mar-bot-15 text-left">
                                    <label class="label bg-green">Total</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin" style="color:#fff;">{{ \App\Document::count()}}</h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 78%;" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn bg-warning res-mg-t-15" style="background-color: #2c4058;">
                            <h4 class="text-left text-uppercase"><b><a style="color:#fff;" href="{{URL('admin/users')}}">User</a></b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="col-xs-3 mar-bot-15 text-left">
                                    <label class="label bg-green">Total</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin" style="color:#fff;">{{ \App\User::count()}}</h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 78%;" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row admin text-center" style="margin-top: 90px;">
            <div class="col-md-12">
                <div class="row">
                   
                   
                </div>
            </div>
        </div>
   @endif

@if(Auth::user()->user_type == 1)

            <div class="row admin text-center"style=" margin-right: -400px;" >
                <div class="col-md-12">
                    <div class="row">
                        <!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">-->
                        <!--    <div class="admin-content analysis-progrebar-ctn res-mg-t-15">-->
                        <!--        <h4 class="text-left text-uppercase"><b><a href="{{URL('admin/document?status=1')}}">Active Document</a></b></h4>-->
                        <!--        <div class="row vertical-center-box vertical-center-box-tablet">-->
                        <!--            <div class="col-xs-3 mar-bot-15 text-left">-->
                        <!--                <label class="label bg-green">Total</label>-->
                        <!--            </div>-->
                        <!--            <div class="col-xs-9 cus-gh-hd-pro">-->
                        <!--                <h2 class="text-right no-margin" style="color:#021968;">{{ \App\Document::where(['createdby'=>Auth::user()->id,'IsActive'=>1])->count()}}</h2>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="progress progress-mini">-->
                        <!--            <div style="width: 78%;" class="progress-bar bg-green"></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div> -->
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn res-mg-t-15 bg-danger" style="background-color: #d5480f;">
                            <h4 class="text-left text-uppercase"><b>
                                <a style="color:#fff;" href="{{URL('admin/document?status=1')}}">Active Document</a></b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="col-xs-3 mar-bot-15 text-left">
                                    <label class="label bg-green">Total</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin" style="color:#fff;">{{ \App\Document::where(['createdby'=>Auth::user()->id,'IsActive'=>1])->count()}}</h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 78%;" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    </div> 
                        <!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">-->
                        <!--    <div class="admin-content analysis-progrebar-ctn res-mg-t-15">-->
                        <!--        <h4 class="text-left text-uppercase"><b><a href="{{URL('admin/document?status=0')}}">Inactive Document</a></b></h4>-->
                        <!--        <div class="row vertical-center-box vertical-center-box-tablet">-->
                        <!--            <div class="col-xs-3 mar-bot-15 text-left">-->
                        <!--                <label class="label bg-green">Total</label>-->
                        <!--            </div>-->
                        <!--            <div class="col-xs-9 cus-gh-hd-pro">-->
                        <!--                <h2 class="text-right no-margin" style="color:#021968;">{{ \App\Document::where(['createdby'=>Auth::user()->id,'IsActive'=>0])->count()}}</h2>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="progress progress-mini">-->
                        <!--            <div style="width: 78%;" class="progress-bar bg-green"></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn bg-primary res-mg-t-15" style="background-color: #ee8f03;">
                            <h4 class="text-left text-uppercase"><b><a style="color:#fff;" href="{{URL('admin/document?status=0')}}">Inactive Document</a></b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="col-xs-3 mar-bot-15 text-left">
                                    <label class="label bg-green">Total</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin" style="color:#fff;">{{ \App\Document::where(['IsActive'=>0])->count()}}</h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 78%;" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn bg-info res-mg-t-15" style="background-color: #0a7eb4;">
                            <h4 class="text-left text-uppercase"><b><a style="color:#fff;" href="{{URL('admin/document')}}">Total Document</a></b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="col-xs-3 mar-bot-15 text-left">
                                    <label class="label bg-green">Total</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin" style="color:#fff;">{{ \App\Document::where('createdby',Auth::user()->id)->count()}}</h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 78%;" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    </div>
                        <!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">-->
                        <!--    <div class="admin-content analysis-progrebar-ctn res-mg-t-15">-->
                        <!--        <h4 class="text-left text-uppercase"><b><a href="{{URL('admin/document')}}">Total Document</a></b></h4>-->
                        <!--        <div class="row vertical-center-box vertical-center-box-tablet">-->
                        <!--            <div class="col-xs-3 mar-bot-15 text-left">-->
                        <!--                <label class="label bg-green">Total</label>-->
                        <!--            </div>-->
                        <!--            <div class="col-xs-9 cus-gh-hd-pro">-->
                        <!--                <h2 class="text-right no-margin">{{ \App\Document::where('createdby',Auth::user()->id)->count()}}</h2>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="progress progress-mini">-->
                        <!--            <div style="width: 78%;" class="progress-bar bg-green"></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                    </div>
                </div>
              

            </div>
             
@endif
@if(Auth::user()->user_type == 2)

            <div class="row admin text-center"style=" margin-right: -400px;" >
                <div class="col-md-12">
                    <div class="row">
                        <!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">-->
                        <!--    <div class="admin-content analysis-progrebar-ctn res-mg-t-15">-->
                        <!--        <h4 class="text-left text-uppercase"><b><a href="{{URL('admin/document?status=1')}}">Active Document</a></b></h4>-->
                        <!--        <div class="row vertical-center-box vertical-center-box-tablet">-->
                        <!--            <div class="col-xs-3 mar-bot-15 text-left">-->
                        <!--                <label class="label bg-green">Total</label>-->
                        <!--            </div>-->
                        <!--            <div class="col-xs-9 cus-gh-hd-pro">-->
                        <!--                <h2 class="text-right no-margin" style="color:#021968;">{{ \App\Document::where(['createdby'=>Auth::user()->id,'IsActive'=>1])->count()}}</h2>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="progress progress-mini">-->
                        <!--            <div style="width: 78%;" class="progress-bar bg-green"></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div> -->
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn res-mg-t-15 bg-danger" style="background-color: #d5480f;">
                            <h4 class="text-left text-uppercase"><b>
                                <a style="color:#fff;" href="{{URL('admin/document?status=1')}}">Active Document</a></b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="col-xs-3 mar-bot-15 text-left">
                                    <label class="label bg-green">Total</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin" style="color:#fff;">{{ \App\Document::where(['createdby'=>Auth::user()->id,'IsActive'=>1])->count()}}</h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 78%;" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    </div> 
                        <!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">-->
                        <!--    <div class="admin-content analysis-progrebar-ctn res-mg-t-15">-->
                        <!--        <h4 class="text-left text-uppercase"><b><a href="{{URL('admin/document?status=0')}}">Inactive Document</a></b></h4>-->
                        <!--        <div class="row vertical-center-box vertical-center-box-tablet">-->
                        <!--            <div class="col-xs-3 mar-bot-15 text-left">-->
                        <!--                <label class="label bg-green">Total</label>-->
                        <!--            </div>-->
                        <!--            <div class="col-xs-9 cus-gh-hd-pro">-->
                        <!--                <h2 class="text-right no-margin" style="color:#021968;">{{ \App\Document::where(['createdby'=>Auth::user()->id,'IsActive'=>0])->count()}}</h2>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="progress progress-mini">-->
                        <!--            <div style="width: 78%;" class="progress-bar bg-green"></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn bg-primary res-mg-t-15" style="background-color: #ee8f03;">
                            <h4 class="text-left text-uppercase"><b><a style="color:#fff;" href="{{URL('admin/document?status=0')}}">Inactive Document</a></b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="col-xs-3 mar-bot-15 text-left">
                                    <label class="label bg-green">Total</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin" style="color:#fff;">{{ \App\Document::where(['IsActive'=>0])->count()}}</h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 78%;" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn bg-info res-mg-t-15" style="background-color: #0a7eb4;">
                            <h4 class="text-left text-uppercase"><b><a style="color:#fff;" href="{{URL('admin/document')}}">Total Document</a></b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="col-xs-3 mar-bot-15 text-left">
                                    <label class="label bg-green">Total</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin" style="color:#fff;">{{ \App\Document::where('createdby',Auth::user()->id)->count()}}</h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 78%;" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    </div>
                        <!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">-->
                        <!--    <div class="admin-content analysis-progrebar-ctn res-mg-t-15">-->
                        <!--        <h4 class="text-left text-uppercase"><b><a href="{{URL('admin/document')}}">Total Document</a></b></h4>-->
                        <!--        <div class="row vertical-center-box vertical-center-box-tablet">-->
                        <!--            <div class="col-xs-3 mar-bot-15 text-left">-->
                        <!--                <label class="label bg-green">Total</label>-->
                        <!--            </div>-->
                        <!--            <div class="col-xs-9 cus-gh-hd-pro">-->
                        <!--                <h2 class="text-right no-margin">{{ \App\Document::where('createdby',Auth::user()->id)->count()}}</h2>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="progress progress-mini">-->
                        <!--            <div style="width: 78%;" class="progress-bar bg-green"></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                    </div>
                </div>
              

            </div>
             
@endif
</div>
@endsection 

@section('extrajs')
<style type="text/css">
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
.analysis-progrebar-ctn h4, .tranffic-als-inner h3 {
    font-size: 15px !important;
}
</style>
@endsection