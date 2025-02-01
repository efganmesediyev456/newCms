@if(isset($route) and isset($title))
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Ana səhifə</a>
                    </li><!--end nav-item-->
                    <li class="breadcrumb-item"><a href="{{ $route }}">{{$title}}</a>
                    </li><!--end nav-item-->
                </ol>
            </div>
            <h4 class="page-title">{{ $title }}</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
@endif
