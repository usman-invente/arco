@extends('Dashboard.home')
@section('content')
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                @if (session('error') || session('message'))
                <div class="alert alert-success" style="float: left; width: 100%;">
                <span class="{{ session('error') ? 'error':'success' }}">{{ session('error') ?? session('message') }}</span>
            </div>
            @endif
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User Registration Management</h4>
                                </div>
                            <form method="POST" action="{{ route('create_user_registration')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="first-name-column" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" name="name" >
                                                            @error('name')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="first-name-column">Full Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="email" id="first-name-column" class="form-control @error('email') is-invalid @enderror" placeholder="E-Mail Address" name="email" >
                                                            @error('email')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="first-name-column">E-Mail Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control @error('nationality_id') is-invalid @enderror select2" id="basicSelect" name="nationality_id">
                                                                @foreach($country as $coun)
                                                                <option value="{{$coun->id}}">{{$coun->country_en}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('nationality_id')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="inputPassword">Nationality</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="number" id="first-name-column" class="form-control @error('contact_number') is-invalid @enderror" placeholder="Contact Number" name="contact_number" >
                                                            @error('contact_number')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="first-name-column">Contact Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="first-name-column" class="form-control @error('qualification') is-invalid @enderror" placeholder="Qualification" name="qualification" >
                                                            @error('qualification')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="first-name-column">Qualification</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="first-name-column" class="form-control @error('address') is-invalid @enderror" placeholder="Address" name="address" >
                                                            @error('address')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="first-name-column">Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="first-name-column" class="form-control @error('city') is-invalid @enderror" placeholder="City" name="city" >
                                                            @error('sequence')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="first-name-column">City</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <div class="form-label-group">
                                                                <select class="form-control @error('volunteer_field_id') is-invalid @enderror" id="basicSelect" name="volunteer_field_id">
                                                    
                                                                    @foreach($volunteer_field as $voun)
                                                                    <option value="{{$voun->id}}">{{$voun->field_en}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('volunteer_field_id')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                                <label for="inputPassword">Volunteering Field</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                      <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <div class="form-label-group">
                                                                <select class="form-control @error('organization_id') is-invalid @enderror" id="basicSelect" name="organization_id">
                                                    
                                                                    @foreach($organization as $orga)
                                                                    <option value="{{$orga->id}}">{{$orga->name_ar}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('organization_id')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                                <label for="inputPassword">Volunteering Field</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="password" id="first-name-column" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" >
                                                            @error('password')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label>Password</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <div class="form-label-group">
                                                                <select class="form-control @error('roll_id') is-invalid @enderror" id="basicSelect" name="role_id">
                                                                    <option value="">Choose The Roll of User..</option>
                                                                    <option value="2">Admin</option>
                                                                    <option value="3"> Volunteer Supervisor</option>
                                                                    <option value="4"> Volunteer Opportunity Officer</option>
                                                                    <option value="5"> Volunteer</option>
                                                                    <option value="6">Site Admin</option>
                                                                </select>
                                                                @error('roll_id')	
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                                <label for="inputPassword">Volunteering Field</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-danger mr-1 mb-1">Update</button>
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
