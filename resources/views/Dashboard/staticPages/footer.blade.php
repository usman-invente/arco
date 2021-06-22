@extends('Dashboard.Layouts.RTL.layout',['title'=>__('dashboard/footer.title') ])


@section('content')


    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-light">{{__('dashboard/footer.title_description')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap col-md-12">
                            @if(!empty($footer))
                                <form method="POST" action="{{ route('footer.update',1)}}" enctype="multipart/form-data">
                                    {{method_field("PATCH")}}
                                    @csrf



                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/footer.data_table_title_1')}}</label>
                                        <textarea class="form-control" rows="5" id="description" name="description"  required>{{$footer->description}}</textarea>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/footer.data_table_title_2')}}</label>
                                        <input type="text" class="form-control" name="facebook"
                                               value="{{$footer->facebook}}" required>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/footer.data_table_title_3')}}</label>
                                        <input type="text" class="form-control"  name="twitter"
                                               value="{{$footer->twitter}}" required>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/footer.data_table_title_4')}}</label>
                                        <input type="text" class="form-control"  name="instagram"
                                               value="{{$footer->instagram}}" required>
                                    </div>
                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/footer.data_table_title_5')}}</label>
                                        <input type="text" class="form-control"  name="youtube"
                                               value="{{$footer->youtube}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/footer.data_table_title_6')}}</label>
                                        <input type="file" name="footer_image" id="footer_image"  >
                                        @if(!empty($footer->footer_image)) <center> <img src="{{ asset('public/images/'.$footer->footer_image) }}" style=" width: 300px; height: 200px;"> </center> @else<span>  Not Found </span> @endif

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



