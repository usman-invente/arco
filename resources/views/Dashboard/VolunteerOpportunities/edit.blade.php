@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('admin_update_Volunteer_Opportunity',$data->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Topic')}}</label>
                                    <input type="text" id="first-name-column" class="form-control"
                                        placeholder="{{__('dashboard/lang.Topic')}}" name="title" value="{{$data->title}}">
                                    @if ($errors->has('title'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Officer')}}</label>
                                    <select class="form-control" name="officer_id">
                                        @foreach ($officers as $officer)
                                            <option @if($officer->id == $data->officer_id) selected @endif value="{{$officer->id}}">{{$officer->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('officer_id'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('officer_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.National Assembly') }}</label>
                                    <select class="form-control" name="organization_id">
                                        @foreach ($organizations as $org)
                                            <option  @if($org->id == $data->organization_id) selected @endif value="{{$org->id}}">{{$org->name_ar}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('organization_id'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('organization_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Country') }}</label>
                                    <select class="form-control" name="country_id">
                                        @foreach ($countries as $country)
                                            <option  @if($country->id == $data->country_id) selected @endif  value="{{$country->id}}">{{$country->country_ar}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country_id'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('country_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.City') }}</label>
                                    <input type="text" class="form-control" value="{{$data->city}}"  name="city" id="city" required>
                                    @if ($errors->has('city'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Start Date') }}</label>
                                    <input type="date" class="form-control"   value="{{$data->start_date}}" name="start_date" id="start_date" required>
                                    @if ($errors->has('start_date'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.End Date') }}</label>
                                    <input type="date" class="form-control"  value="{{$data->end_date}}"  name="end_date" id="end_date" required>
                                    @if ($errors->has('end_date'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.opportunity types') }}</label>
                                    <select name="type_id" id="type_id" placeholder="Select ..." class="form-control" required>

                                        @foreach($types as $type)
                                            <option @if($type->id == $data->type_id) selected @endif  value="{{$type->id}}" >{{$type->type}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type_id'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('type_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Report Image') }}</label>
                                    <input type="file"  name="report_image" id="report_image" >
                                    <img src="{{asset('public/upload/report_image/'.$data->report_image)}}" height="80" width="180" style="margin-top: 10px">
                                    @if ($errors->has('report_image'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('report_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Opportunity Image') }}</label>
                                    <input type="file"  name="opportunity_image" id="report_image" >
                                    <img src="{{asset('public/upload/opportunity_image/'.$data->opportunity_image)}}" height="80" width="180" style="margin-top: 10px">
                                    @if ($errors->has('opportunity_image'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('opportunity_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.volunteers') }}</label>
                                    <select name="volunteer_type" id="type_id" placeholder="Select ..." class="form-control" required>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="female male">Female Male</option>
                                    </select>
                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.opportunity domain') }}</label>
                                    <select name="opportunity_domain" id="type_id" placeholder="Select ..." class="form-control" required>
                                        <option @if($data->opportunity_domain == "Health") selected  @endif value="Health">Health</option>
                                        <option   @if($data->opportunity_domain == "Cultural") selected  @endif value="Cultural">Cultural</option>
                                        <option   @if($data->opportunity_domain == "Management") selected  @endif value="Management">Management</option>
                                        <option  @if($data->opportunity_domain == "Social") selected  @endif value="Social">Social</option>
                                        <option   @if($data->opportunity_domain == "Media") selected  @endif value="Media">Media</option>
                                        <option   @if($data->opportunity_domain == "Entertaining") selected  @endif value="Entertaining">Entertaining</option>
                                        <option   @if($data->opportunity_domain == "Technical") selected  @endif value="Technical">Technical</option>
                                    </select>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Support For Volunteer') }}</label>
                                    <input type="text" class="form-control"  value="{{$data->support_for_volunteer}}" name="support_for_volunteer" id="support_for_volunteer" required>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Benefit For Volunteer') }}</label>
                                    <input type="text" class="form-control"  value="{{$data->benefit_for_volunteer}}"  name="benefit_for_volunteer" id="benefit_for_volunteer" required>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Issues May Be Have') }}</label>
                                    <input type="text" class="form-control" value="{{$data->issues}}"   name="issues" id="issues" required>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Number Of Volunteer Hours') }}</label>
                                    <input type="number" class="form-control" value="{{$data->no_of_hours}}"  name="no_of_hours" id="no_of_hours" required>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.age') }}</label>
                                    <select name="age_type_id" id="age_type_id" placeholder="Select ..." class="form-control" required>

                                        @foreach($ageTypes as $age)
                                            <option  @if($age->id == $data->age_type_id)  selected @endif value="{{$age->id}}" >{{$age->type}}</option>
                                        @endforeach
                                    </select>

                                   
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.opportunity tasks') }}</label>
                                    <input type="text" class="form-control" value="{{$data->tasks}}"  name="tasks" id="no_of_hours" required>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Number of Volunteers') }}</label>
                                    <input type="number" class="form-control"  value="{{$data->no_of_volunteers}}" name="no_of_volunteers" id="no_of_hours" required>

                                   
                                </div>
                            </div><!-- col-4 -->
    
                        </div><!-- row -->
                        <div class="form-layout-footer">
                            <button class="btn btn-info">{{ __('dashboard/lang.Update') }}</button>

                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection
