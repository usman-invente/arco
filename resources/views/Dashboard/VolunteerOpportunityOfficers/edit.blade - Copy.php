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
                                    <h4 class="card-title">{{__('dashboard/lang.Edit Volunteer Opportunity 0fficers') }}</h4>
                                </div>
                            <form method="POST" action="{{ route('admin_update_Volunteer_Opportunity_Officers', $Volunteer_Supervisor->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="file" id="email-id-column" class="form-control" name="person_picture" placeholder="Email">
                                                            <img src="{{asset('public/upload/personal/'.$Volunteer_Supervisor->person_picture)}}" style="margin-top:10px;width:100px;height:100px">
                                                            <label for="email-id-column">{{__('dashboard/lang.Profile Image') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="first-name-column" class="form-control" placeholder="Name" name="name" value="{{$Volunteer_Supervisor->name}}">
                                                            <label for="first-name-column">{{__('dashboard/lang.Name') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="email" id="last-name-column" class="form-control" placeholder="Email" name="email" value="{{$Volunteer_Supervisor->email}}">
                                                            <label for="last-name-column">{{__('dashboard/lang.Email') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="city-column" class="form-control" placeholder="Contact Number" name="contact_number" value="{{$Volunteer_Supervisor->contact_number}}">
                                                            <label for="city-column">{{__('dashboard/lang.Contact Number') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="country-floating" class="form-control" name="address" placeholder="Place Of Residence"value="{{$Volunteer_Supervisor->address}}">
                                                            <label for="country-floating">{{__('dashboard/lang.Place Of Residence') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="company-column" class="form-control" name="city" placeholder="City" value="{{$Volunteer_Supervisor->city}}">
                                                            <label for="company-column">{{__('dashboard/lang.City') }}</label>
                                                        </div>
                                                    </div>
                                                    {{--  <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="password" id="email-id-column" class="form-control" name="password" placeholder="Password">
                                                            <label for="email-id-column">Password</label>
                                                        </div>
                                                    </div>  --}}
                                                  
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" id="basicSelect" name="activeStatus_id">
                                                                <option value="1">Active</option>
                                                                <option value="0">Deactive</option>
                                                            </select>
                                                            <label for="inputPassword">Status</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <div class="form-label-group">
                                                                <select class="form-control @error('organization_id') is-invalid @enderror" id="basicSelect" name="organization_id">
                                                    
                                                                    @foreach($organization as $orga)
                                                                    <option @if($Volunteer_Supervisor->organization_id == $orga->id ) selected @endif value="{{$orga->id}}">{{$orga->name_en}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="inputPassword">Assembly Name</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                      <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="file" id="email-id-column" class="form-control" name="passport_picture" placeholder="Pasport Image">
                                                            <img src="{{asset('public/upload/passport/'.$Volunteer_Supervisor->passport_picture)}}" style="margin-top:10px;width:100px;height:100px">
                                                            <label for="email-id-column">{{__('dashboard/lang.PassPort Image') }}</label>
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