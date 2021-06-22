@extends('Dashboard.Layouts.RTL.layout',['title'=>__('dashboard/counter.title') ])


@section('content')


    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-light">{{__('dashboard/counter.title_description')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap col-md-12">
                            @if(!empty($counter))
                                <form method="POST" action="{{ route('counters.update',1)}}">
                                    {{method_field("PATCH")}}
                                    @csrf

                                        <div class="form-group col-sm-offset-6 col-sm-4">
                                            <label class="control-label mb-10 text-left">{{__('dashboard/counter.data_table_title_5')}}</label>

                                            <select name="data_selection" id="data_selection" placeholder="Select ..." class="form-control" required>--}}
                                                @if($counter->data_selection == "Fixed")
                                                    <option value="Fixed" selected>Fixed</option>
                                                    <option value="Database">Database</option>
                                                @elseif($counter->data_selection == "Database")
                                                    <option value="Fixed">Fixed</option>
                                                    <option value="Database" selected>Database</option>
                                                @endif

                                            </select>
                                            </div>

                                            <div class="form-group col-sm-offset-6 col-sm-4">
                                                <label class="control-label mb-10 text-left">{{__('dashboard/counter.data_table_title_1')}}</label>
                                                <input type="text" class="form-control"  name="no_of_volunteer"
                                                       value="{{$counter->no_of_volunteer}}" required>
                                            </div>
                                            <div class="form-group col-sm-offset-6 col-sm-4">
                                                <label class="control-label mb-10 text-left">{{__('dashboard/counter.data_table_title_2')}}</label>
                                                <input type="text" class="form-control" name="no_of_volunteer_opportunities"
                                                       value="{{$counter->no_of_volunteer_opportunities}}" required>
                                            </div>
                                            <div class="form-group col-sm-offset-6 col-sm-4">
                                                <label class="control-label mb-10 text-left">{{__('dashboard/counter.data_table_title_3')}}</label>
                                                <input type="text" class="form-control"  name="no_of_volunteer_hours"
                                                       value="{{$counter->no_of_volunteer_hours}}" required>
                                            </div>
                                            <div class="form-group col-sm-offset-6 col-sm-4">
                                                <label class="control-label mb-10 text-left">{{__('dashboard/counter.data_table_title_4')}}</label>
                                                <input type="text" class="form-control"  name="no_of_organizations"
                                                       value="{{$counter->no_of_organizations}}" required>
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



