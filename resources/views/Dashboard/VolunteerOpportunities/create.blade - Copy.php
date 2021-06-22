
<div class="row">
    <div class="col-sm-12" style="color: black;">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">
                        <form method="POST" action="{{ route('opportunities.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_18')}}</label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_29')}}</label>
                                    <textarea type="text" class="form-control" rows="5" name="description" id="description" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_14')}}</label>
                                    <input type="text" class="form-control"  name="city" id="city" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_3')}}</label>
                                    <select name="organization_id" id="organization_id" placeholder="Select ..." class="form-control" required>

                                        @foreach($organizations as $organization)
                                            <option value="{{$organization->id}}" >@if(LaravelLocalization::getCurrentLocale() === 'ar') {{$organization->name_ar}} @else {{$organization->name_en}} @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_20')}}</label>
                                        <input type="date" class="form-control"  name="start_date" id="start_date" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_21')}}</label>
                                        <input type="date" class="form-control"  name="end_date" id="end_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_22')}}</label>
                                    <select name="type_id" id="type_id" placeholder="Select ..." class="form-control" required>

                                        @foreach($types as $type)
                                            <option value="{{$type->id}}" >{{$type->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if(\Illuminate\Support\Facades\Auth::user()->role_id != \App\User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER)
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_19')}}</label>
                                        <select name="officer_id" id="officer_id" placeholder="Select ..." class="form-control" required>
                                            <option value=""></option>
                                            @if(!empty($officers))
                                                @foreach($officers as $officer)
                                                    <option value="{{$officer->id}}" >{{$officer->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <br>
                            <br>
                            <br>
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_23')}}</label>
                                        <input type="file"  name="report_image" id="report_image" >
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_24')}}</label>
                                        <input type="file"   name="opportunity_image" id="opportunity_image" >
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_22')}}</label>
                                    <select name="volunteering_field_id" id="volunteering_field_id" placeholder="Select ..." class="form-control" required>

                                        @foreach($volunteeringFields as $field)
                                            <option value="{{$field->id}}" >{{$field->field_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_25')}}</label>
                                    <input type="text" class="form-control"  name="support_for_volunteer" id="support_for_volunteer" required>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_26')}}</label>
                                    <input type="text" class="form-control"  name="benefit_for_volunteer" id="benefit_for_volunteer" required>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_27')}}</label>
                                    <input type="text" class="form-control"  name="issues" id="issues" >

                                </div>
                            </div>



                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_30')}}</label>
                                    <input type="number" class="form-control"  name="no_of_volunteers" id="no_of_volunteers" >
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_31')}}</label>
                                    <input type="number" class="form-control"  name="no_of_hours" id="no_of_hours" >
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_28')}}</label>
                                    <select name="age_type_id" id="age_type_id" placeholder="Select ..." class="form-control" required>

                                        @foreach($ageTypes as $age)
                                            <option value="{{$age->id}}" >{{$age->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_4')}}</label>
                                    <select name="status_id" id="status_id" placeholder="Select ..." class="form-control" required>

                                        @foreach($activeStatus as $status)
                                            <option value="{{$status->id}}" >{{$status->status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group mb-0">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger mr-1 mb-1"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

