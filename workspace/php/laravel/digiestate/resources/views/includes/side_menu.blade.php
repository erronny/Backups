 <div class="left-sidebar-pro" >
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html">
                    <span style="font-size: 35px;"><img src="{{URL('assets/panel-iconwhite.png')}}"></span>
                    {{-- <img class="main-logo" src="{{ asset('assets/img/logo/logo.png')}}" alt="" /> --}}
                </a>
                <strong><img src="img/logo/logosn.png" alt="" /></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                   
                       <li class="active">
                            <a title="Landing Page" href="{{URL('/home')}}" aria-expanded="false"><i class="fa fa-tachometer icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Dashboard</span></a>
                        </li>

<li class="active">
    <a title="Landing Page" href="{{URL('admin/document')}}" aria-expanded="false"><i class="fa fa-file icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Document</span></a>
</li>
@if(Auth::user()->user_type == 1)
<li class="active">
    <a title="Landing Page" href="{{URL('admin/shareDocument')}}" aria-expanded="false"><i class="fa fa-file icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Share Document</span></a>
</li>
<li class="active">
    <a title="Landing Page" href="{{URL('admin/recievedDocument')}}" aria-expanded="false"><i class="fa fa-file icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Received Document</span></a>
</li>
@endif

@if(Auth::user()->user_type == 0)
                       
                         <li class="active" style="display:none;">
                            <a title="Landing Page" href="{{URL('admin/category')}}" aria-expanded="false"><i class="fa fa-bookmark icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Category</span></a>
                        </li>
                      
                         <li class="active">
                            <a title="Landing Page" href="{{URL('admin/users')}}" aria-expanded="false"><i class="fa fa-users icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Users</span></a>
                        </li>


                         <li class="active">
                            <a title="Landing Page" href="{{URL('admin/userWiseReport')}}" aria-expanded="false"><i class="fa fa-users icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Report</span></a>
                        </li>
@endif
@if(Auth::user()->role_id == 18)


                        <li><a>Representative</a></li>
                         <li class="active">
                            <a title="Landing Page" href="{{URL('admin/university')}}" aria-expanded="false"><i class="fa fa-bookmark icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">University</span></a>
                        </li>

                         <li class="active">
                            <a title="Landing Page" href="{{URL('admin/college')}}" aria-expanded="false"><i class="fa fa-bookmark icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">College</span></a>
                        </li>

                         <li class="active">
                            <a title="Landing Page" href="{{URL('admin/order')}}" aria-expanded="false"><i class="fa fa-bookmark icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Order</span></a>
                        </li>
                        
                        <li class="active">
                            <a title="Landing Page" href="{{URL('admin/users/agent')}}" aria-expanded="false"><i class="fa fa-bookmark icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Agent</span></a>
                        </li>
@endif
@if(Auth::user()->role_id == 19)
                        <li><a>Agent</a></li>
                         <li class="active">
                            <a title="Landing Page" href="{{URL('admin/place_order')}}" aria-expanded="false"><i class="fa fa-bookmark icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">Place Order</span></a>
                        </li>

                        <li class="active">
                            <a title="Landing Page" href="{{URL('admin/myOrder')}}" aria-expanded="false"><i class="fa fa-bookmark icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-click-non">My Order</span></a>
                        </li>  

@endif                      
                    </ul>
                </nav>
            </div>
        </nav>
    </div>