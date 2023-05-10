@php
    $breadrumbs = $menu['breadcrumbs'];
@endphp
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">CMS</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">

                    @if(!empty($breadrumbs->parent))
                        <li class="breadcrumb-item">
                            <a href="#">{{ucfirst($breadrumbs->parent->name)}}</a>
                            <span class="" aria-hidden="true"></span>
                        </li>
                    @endif
                        <li class="breadcrumb-item active">
                            <a href="{{route("$breadrumbs->route_name")}}">{{ucfirst($breadrumbs->name)}}</a>
                        </li>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
