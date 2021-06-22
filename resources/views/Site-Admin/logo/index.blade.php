@extends('Dashboard.home')
@section('content')
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<!-- BEGIN: Content-->
<div class="app-content content">
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
    @if (session('error') || session('message'))
    <div class="alert alert-success" style="float: left; width: 100%;">
    <span class="{{ session('error') ? 'error':'success' }}">{{ session('error') ?? session('message') }}</span>
</div>
@endif
<div class="content-body">
<section id="multiple-column-form">
<div class="row match-height">
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{__('dashboard/lang.Change Or Update The Logos Of The Web') }}</h4>
        </div>
    <form method="POST" action="{{ route('create_logo') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-content">
            <div class="card-body">
                <form class="form">
                    <div class="form-body">
                        <div class="row">
                            
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="file" id="email-id-column" class="form-control" name="web_header_logo" placeholder="Website Header Logo">
                                    <img src="{{asset('upload/web-logo/'.$flogo->logo)}}"  style="margin-top: 10px;width:200px;height:200px">
                                    <label for="email-id-column">{{__('dashboard/lang.Website Header Logo') }}</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="file" id="email-id-column" class="form-control" name="web_footer_logo" placeholder="Website Footer Logo">
                                    <img src="{{asset('public/upload/web-logo/'.$slogo->logo)}}"  style="margin-top: 10px;width:200px;height:200px">
                                    <label for="email-id-column">{{__('dashboard/lang.Website Footer Logo') }}</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-danger mr-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
    </div>
</div>
</div>
</section>
</form>

</div>
</div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
</body>

@endsection
