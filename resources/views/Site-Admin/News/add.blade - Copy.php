@extends('layouts.app')
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
                                    <h4 class="card-title">{{__('dashboard/lang.Create News') }}</h4>
                                </div>
                            <form method="POST" action="{{ route('site_create_news') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <textarea class="form-control @error('description') is-invalid @enderror summernote" name="description" id="basicTextarea" rows="3" placeholder="{{__('dashboard/lang.Description') }}"></textarea>
                                                            @error('description')	
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            <label for="first-name-column">Description</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="first-name-column" class="form-control @error('address') is-invalid @enderror" placeholder="{{__('dashboard/lang.Address') }}" name="address">
                                                            @error('address')	
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            <label for="first-name-column">{{__('dashboard/lang.Addres') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" id="basicSelect" name="status">
                                                                <option value="Published">Published</option>
                                                                <option value="Not Published">Not Published</option>
                                                            </select>
                                                            <label for="inputPassword">Nationality</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="file" id="email-id-column" class="form-control @error('image') is-invalid @enderror" name="image" placeholder=" Image">
                                                            @error('image')	
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            <label for="email-id-column">{{__('dashboard/lang.Image') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <textarea class="form-control @error('content') is-invalid @enderror summernote" name="content" id="basicTextarea" rows="3" placeholder="{{__('dashboard/lang.Description') }}"></textarea>
                                                            @error('content')	
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            <label for="first-name-column">Description</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
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