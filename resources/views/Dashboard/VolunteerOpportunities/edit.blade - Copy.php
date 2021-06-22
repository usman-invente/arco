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
                                    <h4 class="card-title"> {{__('dashboard/lang.Edit Volunteer Opportunity') }} </h4>
                                </div>
                                <form method="POST" action="{{ route('admin_update_Volunteer_Opportunity',$data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="email-id-column" class="form-control" value="{{$data->title}}" name="title" placeholder="Topic">
                                                                <label for="email-id-column"> {{__('dashboard/lang.Topic') }} </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <fieldset class="form-group">
                                                                    <textarea class="form-control summernote"name="description"  id="basicTextarea" rows="3" placeholder="Description">{{$data->description}}</textarea>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                             <p> {{__('dashboard/lang.Assembly') }}</p>
                                                            <select class="form-control" id="basicSelect" name="organization_id">
                                                                @foreach ($organization as $key =>$val)
                                                                <option value="{{$key}}">{{$val}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="last-name-column" value="{{$data->city}}" class="form-control" placeholder="City" name="city">
                                                                <label for="last-name-column">{{__('dashboard/lang.City') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                
                                                                <input type="date" id="country-floating" class="form-control" value="{{$data->start_date}}" name="start_date" placeholder="start Date">
                                                                <label for="country-floating">{{__('dashboard/lang.Start Date') }}</label>
                                                              
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="date" id="country-floating" class="form-control" value="{{$data->end_date}}" name="end_date" placeholder="End Date">
                                                                <label for="country-floating">{{__('dashboard/lang.End Date') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                            <select class="form-control" id="basicSelect" name="officer_id">
                                                                @foreach ($officer as $key =>$val)
                                                                <option value="{{$key}}">{{$val}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="inputPassword">Officer</label>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                            <select class="form-control" id="basicSelect" name="type_id">
                                                                
                                                                <option value="1"{{ $data->type_id  =="Inside Assembly"  ? 'selected="selected"' : '' }}>
                                                                    Inside Assembly
                                                                </option>
                                                                <option value="2"{{ $data->type_id  =="Outside Assembly"  ? 'selected="selected"' : '' }}>
                                                                    Outside Assembly
                                                                </option>
                                                                <option value="3"{{ $data->type_id  =="Community Initiative"  ? 'selected="selected"' : '' }}>
                                                                    Community Initiative
                                                                </option>
                                                                <option value="4"{{ $data->type_id  =="Remotely"  ? 'selected="selected"' : '' }}>
                                                                    Remotely
                                                                </option>
                                                            </select>
                                                            <label for="inputPassword">Opportunity Type</label>
                                                        </div>
                                                        </div>
    
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="file" id="email-id-column" class="form-control" name="opportunity_image" placeholder="Opportunity Image">
                                                                <img src="{{asset('upload/opportunity_image/'.$data->opportunity_image)}}" height="80" width="180" style="margin-top: 10px">
                                                                <label for="email-id-column">{{__('dashboard/lang.Opportunity Image') }}</label>
                                                            </div>
                                                        </div>
    
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="file" id="email-id-column" class="form-control" name="report_image" placeholder="Report Image">
                                                                <img src="{{asset('upload/report_image/'.$data->report_image)}}" height="80" width="180" style="margin-top: 10px">
                                                                <label for="email-id-column">{{__('dashboard/lang.Report Image') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="email-id-column" class="form-control" value="{{$data->support_for_volunteer}}" name="support_for_volunteer" placeholder="Support For Volunteer">
                                                                <label for="email-id-column">{{__('dashboard/lang.Support For Volunteer') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                            <select class="form-control" id="basicSelect" name="volunteering_field_id">
                                                                @foreach ($volunteer_field as $key =>$val)
                                                                {{--  <option value="{{ $key }}" {{ ( $key  ? 'selected' : '' }}> 
                                                                    {{ $val }} 
                                                                </option>  --}}

                                                                <option value="{{$key}}">{{$val}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="inputPassword">{{__('dashboard/lang.Volunteering Field') }}</label>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="email-id-column" class="form-control" value="{{$data->issues}}" name="issues" placeholder="Issues May Be Have">
                                                                <label for="email-id-column">{{__('dashboard/lang.Issues May Be Have') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="email-id-column" class="form-control" value="{{$data->benefit_for_volunteer}}" name="benefit_for_volunteer" placeholder="Benefit For Volunteer">
                                                                <label for="email-id-column">{{__('dashboard/lang.Benefit For Volunteer') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                            <select class="form-control" id="basicSelect" name="status_id">
                                                                <option value="1"{{ $data->status_id =="1"  ? 'selected="selected"' : '' }}>
                                                                    Active
                                                                </option>
                                                                <option value="2"{{ $data->status_id =="2"  ? 'selected="selected"' : '' }}>
                                                                    Deactive
                                                                </option>
                                                            </select>
                                                            <label for="inputPassword">{{__('dashboard/lang.Status') }}</label>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                            <select class="form-control" id="basicSelect" name="age_type_id">
                                                                <option value="1"{{ $data->age_type_id  =="10-14"  ? 'selected="selected"' : '' }}>
                                                                    10-14
                                                                </option>
                                                                <option value="2"{{ $data->age_type_id  =="15-18"  ? 'selected="selected"' : '' }}>
                                                                    15-18
                                                                </option>
                                                                <option value="3"{{ $data->age_type_id  =="18-25"  ? 'selected="selected"' : '' }}>
                                                                    18-25
                                                                </option>
                                                                <option value="4"{{ $data->age_type_id  =="25-40"  ? 'selected="selected"' : '' }}>
                                                                    25-40
                                                                </option>
                                                                <option value="5"{{ $data->age_type_id  =="41-75"  ? 'selected="selected"' : '' }}>
                                                                    41-75
                                                                </option>
                                                                <option value="6"{{ $data->age_type_id  =="All Types"  ? 'selected="selected"' : '' }}>
                                                                    All Types
                                                                </option>
                                                            </select>
                                                            <label for="inputPassword">Types of Age</label>
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