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
            <h4 class="card-title">Create Page</h4>
        </div>
    <form method="POST" action="{{ route('create_page') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-content">
            <div class="card-body">
                <form class="form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" id="email-id-column" class="form-control @error('title_en') is-invalid @enderror" name="title_en" placeholder="Title (English)">
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
                                    <input type="text" id="email-id-column" class="form-control @error('title_ar') is-invalid @enderror" name="title_ar" placeholder="Title (Arabic)">
                                    @error('title_ar')	
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
                                    <label>Title (Arabic)</label>
                                </div>
                            </div>
                         
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" id="last-name-column" class="form-control @error('heading') is-invalid @enderror" placeholder="Heading" name="heading">
                                    @error('heading')	
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
                                    <label for="last-name-column">Heading</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-label-group">
                                    <fieldset class="form-group">
                                        <textarea class="form-control @error('content') is-invalid @enderror summernote"name="content" id="basicTextarea" rows="3" placeholder="Description"></textarea>
                                        @error('content')	
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="file" id="email-id-column" class="form-control @error('page_image') is-invalid @enderror" name="page_image" placeholder="Page Image">
                                    @error('page_image')	
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
                                    <label for="email-id-column">Page Image</label>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                <select class="form-control" id="basicSelect" name="status_id">
                                    <option value="1">Published</option>
                                    <option value="2">Not Published</option>
                                </select>
                                <label for="inputPassword">Status</label>
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
