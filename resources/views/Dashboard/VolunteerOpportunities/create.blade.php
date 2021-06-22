@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('admin_create_Volunteer_Opportunity') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Topic')}}</label>
                                    <input type="text" id="first-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.Name') }}" name="title" required>
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
                                    <select class="form-control" name="officer_id" required>
                                        @foreach ($officers as $officer)
                                            <option value="{{$officer->id}}">{{$officer->name}}</option>
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
                                    <select class="form-control" name="organization_id" required>
                                        @foreach ($organizations as $org)
                                            <option value="{{$org->id}}">{{$org->name_ar}}</option>
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
                                    <select class="form-control" name="country_id" required>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->country_ar}}</option>
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
                                    <input type="text" class="form-control"  name="city" id="city" required>
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
                                    <input type="date" class="form-control"  name="start_date" id="start_date" required>
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
                                    <input type="date" class="form-control"  name="start_date" id="end_date" required>
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
                                            <option value="{{$type->id}}" >{{$type->type}}</option>
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
                                    <input type="file"  name="report_image" id="report_image" required>
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
                                    <input type="file"  name="opportunity_image" id="report_image" required >
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
                                        <option value="Health">Health</option>
                                        <option value="Cultural">Cultural</option>
                                        <option value="Management">Management</option>
                                        <option value="Social">Social</option>
                                        <option value="Media">Media</option>
                                        <option value="Entertaining">Entertaining</option>
                                        <option value="Technical">Technical</option>
                                    </select>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Support For Volunteer') }}</label>
                                    <input type="text" class="form-control"  name="support_for_volunteer" id="support_for_volunteer" required>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Benefit For Volunteer') }}</label>
                                    <input type="text" class="form-control"  name="benefit_for_volunteer" id="benefit_for_volunteer" required>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Issues May Be Have') }}</label>
                                    <input type="text" class="form-control"  name="issues" id="issues" required>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Number Of Volunteer Hours') }}</label>
                                    <input type="number" class="form-control"  name="no_of_hours" id="no_of_hours" required>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.age') }}</label>
                                    <select name="age_type_id" id="age_type_id" placeholder="Select ..." class="form-control" required>

                                        @foreach($ageTypes as $age)
                                            <option value="{{$age->id}}" >{{$age->type}}</option>
                                        @endforeach
                                    </select>

                                   
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.opportunity tasks') }}</label>
                                    <input type="text" class="form-control"  name="tasks" id="no_of_hours" required>

                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Number of Volunteers') }}</label>
                                    <input type="number" class="form-control"  name="no_of_volunteers" id="no_of_hours" required>

                                   
                                </div>
                            </div><!-- col-4 -->
    
                        </div><!-- row -->
                        <input type="hidden" name="role_id" value="4">
                        <div class="form-layout-footer">
                            <button class="btn btn-info">{{ __('dashboard/lang.Add') }}</button>

                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection
