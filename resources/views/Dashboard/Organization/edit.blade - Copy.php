@extends('Dashboard.home')
@section('content')
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{__('dashboard/lang.Edit Organization') }}</h4>
                                </div>
                            <form method="POST" action="{{ route('admin_update_organization',$organization->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text"  class="form-control" placeholder="Assembly Name (English)" value="{{$organization->name_en}}" name="name_en">
                                                            <label >{{__('dashboard/lang.Assembly Name (English)') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text"  class="form-control" placeholder="Assembly Name (Arabic)" value="{{$organization->name_ar}}" name="name_ar">
                                                            <label >{{__('dashboard/lang.Assembly Name (Arabic)') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="email"  class="form-control" placeholder="Email"value="{{$organization->email}}" name="email">
                                                            <label >{{__('dashboard/lang.Email') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text"  class="form-control" placeholder="Web Site Url" value="{{$organization->site_url}}" name="site_url">
                                                            <label >{{__('dashboard/lang.Web Site Url') }}</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <textarea class="form-control summernote" name="details" id="basicTextarea" rows="3" placeholder="Description">{{$organization->details}}</textarea>
                                                            <label >{{__('dashboard/lang.Description') }}</label>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="file" id="email-id-column" class="form-control" name="logo"value="{{old($organization->logo)}}" placeholder="Logo Image">
                                                            <img src="{{asset('upload/logo/'.$organization->logo)}}" height="80" width="180" style="margin-top: 10px;width: 200px;
                                                            height: 200px;">
                                                            <label for="email-id-column">{{__('dashboard/lang.Logo Image') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="file" id="email-id-column" class="form-control" name="banner" value="{{$organization->banner}}"placeholder="Banner Image">
                                                            <img src="{{asset('upload/banner/'.$organization->banner)}}" height="80" width="180" style="margin-top: 10px;width: 200px;
                                                            height: 200px;">
                                                            <label for="email-id-column">{{__('dashboard/lang.Banner Image') }}</label>
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
