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
                                    <h4 class="card-title">Edit Page </h4>
                                </div>
                                <form method="POST" action="{{ route('update_page',$data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="email-id-column" class="form-control @error('title_en') is-invalid @enderror" value="{{$data->title_en}}" name="title_en" placeholder="Title (English)">
                                                                @error('title_en')	
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                <label for="email-id-column">Title (English)</label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="email-id-column" class="form-control @error('title_ar') is-invalid @enderror" value="{{$data->title_ar}}" name="title_ar" placeholder="Title (Arabic)">
                                                                @error('title_ar')	
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                <label for="email-id-column">Title (Arabic)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="last-name-column" value="{{$data->heading}}" class="form-control @error('heading') is-invalid @enderror" placeholder="Heading" name="heading">
                                                                
                                                                @error('heading')	
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror<label for="last-name-column">Heading</label>
                                                            </div>
                                                        </div>
    
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="file" id="email-id-column" class="form-control" name="slider_image" placeholder="Slider Image">
                                                                
                                                                <img src="{{asset('upload/page_image/'.$data->slider_image)}}" height="80" width="180" style="margin-top: 10px">
                                                                <label for="email-id-column">Slider Image</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                            <select class="form-control" id="basicSelect" name="status">
                                                                <option value="Published"{{ $data->status =="Published"  ? 'selected="selected"' : '' }}>
                                                                    Published
                                                                </option>
                                                                <option value="Not Published"{{ $data->status =="Not Published"  ? 'selected="selected"' : '' }}>
                                                                    Not Published
                                                                </option>
                                                            </select>
                                                            <label for="inputPassword">Status</label>
                                                        </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <fieldset class="form-group">
                                                                    <textarea class="form-control @error('description') is-invalid @enderror"name="description"  id="basicTextarea" rows="3" placeholder="Description">{{$data->description}}</textarea>
                                                                    @error('description')	
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                </fieldset>
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