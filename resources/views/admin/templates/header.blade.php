<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="javascript:void(0);">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block">

                    <div class="bookmark-input search-input">
                        <div class="bookmark-input-icon">
                            <i data-feather="search"></i>
                        </div>
                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
                        <ul class="search-list search-list-bookmark"></ul>
                    </div>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    <i class="ficon" data-feather="moon"></i>
                </a>
            </li>
            <li class="nav-item nav-search">

                <div class="search-input">
                    <div class="search-input-icon">
                        <i data-feather="search"></i>
                    </div>
                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                    <div class="search-input-close">
                        <i data-feather="x"></i>
                    </div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-notification mr-25" id="notifApp">
                <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                    <i class="ficon" data-feather="bell"></i>
                    <span class="badge badge-pill badge-danger badge-up">@{{ totalnotifCount }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            <div class="badge badge-pill badge-light-primary">@{{ totalnotifCount }}  New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list" v-for="orderList in orderLists">

                        <a class="media d-flex align-items-start" href="#">
                            <div class="media-left">
                                <div class="avatar bg-light-danger">
                                    <div class="avatar-content">
                                        <i class="avatar-icon" data-feather="x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="media-body">
                                <p class="media-heading">
                                    <span class="font-weight-bolder">New order #@{{orderList.order_code}}</span>
                                </p>
                                <small class="notification-text">Area : @{{orderList.area_name}} </small>
                            </div>
                        </a>


                        {{--                        <a class="d-flex" href="javascript:void(0)">--}}
{{--                            <div class="media d-flex align-items-start">--}}
{{--                                --}}
{{--                            </div>--}}
{{--                        </a>--}}

                    </li>

                    <li class="dropdown-menu-footer">
{{--                        <a class="btn btn-primary btn-block" @click="order()">Test create order</a>--}}
                        <a class="btn btn-primary btn-block" href="#">Read all notification</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown dropdown-notification nav-item" id="chatApp">
                <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                    <i class="ficon" data-feather="mail"></i>
                    <span class="badge badge-pill badge-danger badge-up badge-glow">@{{ totalmsgCount }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <h6 class="dropdown-header m-0"><span class="grey darken-2">Chatting</span></h6>
                    </li>
                    <li>
                        <div class="col-md-12" id="chatApp" style="padding: 20px">
                            <div class="panel panel-default ffside">
                                <div class="panel-heading">Online Users</div>
                                <div class="panel-body mt-1" style="padding:0px;">
                                    <ul class="list-group">
                                        <li class="list-group-item" v-for="chatList in chatLists"
                                            style="cursor: pointer;" @click="chat(chatList)">

                                            <div class="media d-flex align-items-start">
                                                <div class="media-left">
                                                    <div class="avatar">
                                                        <img :src="(chatList.profile_picture ? '/storage/images/'+  chatList.profile_picture : '/img/no_image.jpg')"  alt="p" width="32" height="32">
                                                    </div>
                                                </div>
                                                <div class="media-body ml-1">
                                                    <p class="media-heading">
                                                        <span class="font-weight-bolder"> @{{ chatList.username  }}</span>
                                                    </p>
                                                    <small class="notification-text"> @{{ chatList.groupname }}</small>
                                                </div>
                                                <i class="fa fa-circle pull-right"
                                                   v-bind:class="{'online': (chatList.online=='Y')}"></i>
                                                <br>
                                                <span class="badge badge-danger mt-2" style="margin-left:-12px !important;" v-if="chatList.msgCount !=0">@{{ chatList.msgCount }}</span>
                                            </div>

                                        </li>
                                        <li class="list-group-item" v-if="socketConnected.status == false">@{{
                                            socketConnected.msg }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">{{\Illuminate\Support\Facades\Auth::user()->username}}</span>
                        <span class="user-status">{{\Illuminate\Support\Facades\Auth::user()->group->name}}</span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{ Auth::user()->profile_picture ? asset('storage/images/'.Auth::user()->profile_picture) : asset('img/avatar/avatar-2.jpg')}}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('dashboard_profile') }}">
                        <i class="mr-50" data-feather="user"></i> Profile </a>

                    <form action="{{route('logout')}}" method="POST" style="margin-bottom: -3px">
                        @csrf
                        <button type="submit" class="dropdown-item" href="{{route('logout')}}" style="width: 100%">
                            <i class="mr-50" data-feather="power"></i> Logout
                        </button>

                    </form>

                    {{-- <a class="dropdown-item" href="{{route('logout')}}">--}}
                    {{-- <i class="mr-50" data-feather="power"></i> Logout --}}
                    {{-- </a>--}}
                </div>
            </li>
        </ul>
    </div>
</nav>
<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center">
        <a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Files</h6>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75">
                    <img src="{{asset('vuexy/app-assets/images/icons/xls.png')}}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p>
                    <small class="text-muted">Marketing Manager</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;17kb</small>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75">
                    <img src="{{asset('vuexy/app-assets/images/icons/jpg.png')}}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p>
                    <small class="text-muted">FontEnd Developer</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;11kb</small>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75">
                    <img src="{{asset('vuexy/app-assets/images/icons/pdf.png')}}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p>
                    <small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;150kb</small>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75">
                    <img src="{{asset('vuexy/app-assets/images/icons/doc.png')}}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna_Strong.doc</p>
                    <small class="text-muted">Web Designer</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;256kb</small>
        </a>
    </li>
    <li class="d-flex align-items-center">
        <a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Members</h6>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75">
                    <img src="{{asset('vuexy/app-assets/images/portrait/small/avatar-s-8.jpg')}}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">John Doe</p>
                    <small class="text-muted">UI designer</small>
                </div>
            </div>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75">
                    <img src="{{asset('vuexy/app-assets/images/portrait/small/avatar-s-1.jpg')}}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Michal Clark</p>
                    <small class="text-muted">FontEnd Developer</small>
                </div>
            </div>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75">
                    <img src="{{asset('vuexy/app-assets/images/portrait/small/avatar-s-14.jpg')}}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Milena Gibson</p>
                    <small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75">
                    <img src="{{asset('vuexy/app-assets/images/portrait/small/avatar-s-6.jpg')}}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna Strong</p>
                    <small class="text-muted">Web Designer</small>
                </div>
            </div>
        </a>
    </li>
</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between">
        <a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start">
                <span class="mr-75" data-feather="alert-circle"></span>
                <span>No results found.</span>
            </div>
        </a>
    </li>
</ul>
<!-- END: Header-->
