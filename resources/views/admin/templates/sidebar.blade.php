@php $activeMenu = $menu['breadcrumbs']; @endphp
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="#">
                    <img class="" alt="logo" style="width:200px !important; height:40px !important"
                         src="{{(!empty($setting['logo_icon']) ? asset('upload/'.$setting['logo_icon']) : asset('vuexy/app-assets/images/logo/logo.png'))}}">
{{--                    <h2 class="brand-text">{{($setting['app_name_short'] ? $setting['app_name_short'] : '')}}</h2>--}}
                </a>
            </li>

        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            @foreach($menu['parentMenu'] as $item => $value)

                @if($value->is_showed)




                    @if($item == 1 )
                        <li class=" navigation-header">
                            <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span>
                            <i data-feather="more-horizontal"></i>
                        </li>
                    @endif

                    @foreach($value->access as $val)
                        @if ($val->id == \Illuminate\Support\Facades\Auth::user()->group_id)

                            @if($val->pivot->is_viewable == true)

                                @if($value->childs->isEmpty())
                                    <li class="nav-item {{($value->name == $activeMenu->name ? 'active' : '')}}">
                                        <a href="{{route("$value->route_name")}}" class="d-flex align-items-center">
{{--                                                <span class="pcoded-micon">--}}
{{--                                                    <i class="{{$value->icon}}"></i>--}}
{{--                                                </span>--}}
                                            <i data-feather="{{$value->icon}}"></i>
                                            <span class="menu-title text-truncate" data-i18n="{{$value->name}}">{{$value->name}}</span>

                                        </a>
                                    </li>

                                @else
                                    <li
                                        class="nav-item {{($activeMenu->parent ? $activeMenu->parent->name == $value->name ? 'active ' : '' : '')}}">
                                        <a href="#" class="d-flex align-items-center ">

                                            <i data-feather="{{$value->icon}}" style="color: #000000 !important;"></i>
{{--                                            <span class="pcoded-micon"><i class="{{$value->icon}}"></i></span>--}}
{{--                                            <span class="pcoded-mtext">{{$value->name}}</span></a>--}}
                                            <span class="menu-title text-truncate" data-i18n="{{$value->name}}">{{$value->name}}</span>

                                        </a>
                                            <ul class="menu-content">
                                            @foreach($value->childs as $key => $sub)
                                                @foreach($sub->access as $key => $subaccess)
                                                    @if($subaccess->count() > 0)
                                                        @if($subaccess->id == \Illuminate\Support\Facades\Auth::user()->group_id && $subaccess->pivot->is_viewable == true)
                                                                <li class="{{($sub->name == $activeMenu->name ? 'active' : '')}}">
                                                                    <a class="d-flex align-items-center" href="{{route("$sub->route_name")}}">
                                                                        <i data-feather="circle"></i>
                                                                        <span class="menu-item text-truncate" data-i18n="{{$sub->name}}">{{$sub->name}}</span>
                                                                    </a>
                                                                </li>

                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            </ul>

                                    </li>
                                @endif
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach

        </ul>
    </div>
</div>
<!-- END: Main Menu-->