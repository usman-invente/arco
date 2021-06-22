@extends('Dashboard.Layouts.RTL.layout',['title'=>__('dashboard/contact_us.title') ])


@section('content')


    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-light">{{__('dashboard/contact_us.title_description')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap col-md-12">
                            @if(!empty($contact_us))
                                <form method="POST" action="{{ route('contact_us.update',1)}}">
                                    {{method_field("PATCH")}}
                                    @csrf




                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/contact_us.data_table_title_1')}}</label>
                                        <input type="text" class="form-control"  name="main_address"
                                               value="{{$contact_us->main_address}}" required>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/contact_us.data_table_title_2')}}</label>
                                        <input type="text" class="form-control" name="second_address"
                                               value="{{$contact_us->second_address}}" required>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/contact_us.data_table_title_3')}}</label>
                                        <input type="text" class="form-control"  name="main_phone"
                                               value="{{$contact_us->main_phone}}" required>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/contact_us.data_table_title_4')}}</label>
                                        <input type="text" class="form-control"  name="second_phone"
                                               value="{{$contact_us->second_phone}}" required>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/contact_us.data_table_title_5')}}</label>
                                        <input type="text" class="form-control"  name="email"
                                               value="{{$contact_us->email}}" required>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/contact_us.data_table_title_6')}}</label>
                                        <input type="text" class="form-control"  name="second_email"
                                               value="{{$contact_us->second_email}}" required>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/contact_us.data_table_title_7')}}</label>
                                        <input type="text" class="form-control"  name="location"
                                               value="{{$contact_us->location}}" required>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/contact_us.data_table_title_8')}}</label>
                                        <input type="text" class="form-control"  name="time"
                                               value="{{$contact_us->time}}" required>
                                    </div>



                                    <div class="form-group mb-0">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                                        </div>
                                    </div>

                                </form>
                            @else
                                <h1> NOT FOUND</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->




@endsection



