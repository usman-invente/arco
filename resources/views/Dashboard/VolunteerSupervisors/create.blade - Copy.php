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
                                    <h4 class="card-title">Create Volunteer Supervisor</h4>
                                </div>
                            <form method="POST" action="{{ route('admin_create_Volunteer_Supervisor') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="file" id="email-id-column" class="form-control" name="person_picture" placeholder="Email">
                                                            <input type="hidden" id="email-id-column" class="form-control" value="3" name="role_id" placeholder="Email">
                                                            <label for="email-id-column">Profile Image</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="first-name-column" class="form-control" placeholder="Name" name="name">
                                                            <label for="first-name-column">Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="email" id="last-name-column" class="form-control" placeholder="Email" name="email">
                                                            <label for="last-name-column">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="city-column" class="form-control" placeholder="Contact Number" name="contact_number">
                                                            <label for="city-column">Contact Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="country-floating" class="form-control" name="address" placeholder="Place Of Residence">
                                                            <label for="country-floating">Place Of Residence</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="company-column" class="form-control" name="city" placeholder="City">
                                                            <label for="company-column">City</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <div class="form-label-group">
                                                                <select class="form-control @error('organization_id') is-invalid @enderror" id="basicSelect" name="organization_id">
                                                    
                                                                    @foreach($organizations as $orga)
                                                                    <option value="{{$orga->id}}">{{$orga->name_en}}</option>
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
                                                            <input type="password" id="email-id-column" class="form-control" name="password" placeholder="Password">
                                                            <label for="email-id-column">Password</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="file" id="email-id-column" class="form-control" name="passport_picture" placeholder="Pasport Image">
                                                            <label for="email-id-column">Pasport Image</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" id="basicSelect" name="activeStatus_id	">
                                                                <option value="1">Active</option>
                                                                <option value="2">Deactive</option>
                                                            </select>
                                                            <label for="inputPassword">Status</label>
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
