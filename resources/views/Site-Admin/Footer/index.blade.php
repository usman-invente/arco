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
            <h4 class="card-title">{{__('dashboard/lang.Footer Of The Websites') }}</h4>
        </div>
    <form method="POST" action="{{ route('create_footer') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-content">
            <div class="card-body">
                <form class="form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-label-group">
                                    
                                       
                                        <textarea class="form-control @error('description') is-invalid @enderror summernote"name="description" id="basicTextarea" rows="3" placeholder="Description">{{ $footer->description ?? ''}}</textarea>
                                        <label for="email-id-column">{{__('dashboard/lang.Footer Of The Websites') }}</label>
                                        @error('description')	
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" id="email-id-column" class="form-control @error('facebook') is-invalid @enderror" name="facebook" placeholder="FaceBook Link" value="{{ $footer->facebook ?? ''}}">
                                    @error('facebook')	
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <label for="email-id-column">{{__('dashboard/lang.FaceBook Link') }}</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" id="email-id-column" class="form-control @error('twitter') is-invalid @enderror" name="twitter" placeholder="Twitter Link" value="{{ $footer->twitter ?? ''}}">
                                    @error('twitter')	
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    <label for="email-id-column">{{__('dashboard/lang.Twitter Link') }}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" id="last-name-column" class="form-control @error('instagram') is-invalid @enderror" placeholder="Instagram Link" name="instagram" value="{{ $footer->instagram ?? ''}}">
                                    @error('instagram')	
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <label for="last-name-column">{{__('dashboard/lang.Instagram Link') }}</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" id="last-name-column" class="form-control @error('youtube') is-invalid @enderror" placeholder="Youtube Link" name="youtube" value="{{ $footer->youtube ?? ''}}">
                                    @error('youtube')	
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <label for="last-name-column">{{__('dashboard/lang.Youtube Link') }}</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="file" id="email-id-column" class="form-control" name="footer_image" placeholder="Footer Image">
                                    <img src="{{asset('upload/footer-image/'.$footer->footer_image)}}" height="80" width="180" style="margin-top: 10px">
                                    <label for="email-id-column">{{__('dashboard/lang.Footer Image') }}</label>
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
