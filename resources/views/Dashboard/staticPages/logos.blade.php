@extends('Dashboard.Layouts.RTL.layout',['title'=>__('dashboard/home.logo_section_title') ])


@section('content')


    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-light">{{__('dashboard/home.logo_title_description')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in" style="background-color: rgba(128,128,128,0.45);">
                    <div class="panel-body">
                        <div class="form-wrap col-md-12">
                            @if(!empty($logos))

                                <form method="POST" action="{{ route('logos.update',1)}}" enctype="multipart/form-data">
                                    {{method_field("PATCH")}}
                                    @csrf

                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/home.head_logo')}}</label>
                                        <br>

                                        <div class="col-sm-6">
                                            <input type="file" class="form-control"  name="logo_head">
                                        </div>

                                        <div class="col-sm-6">
                                            @if(!empty($logos[0]->logo)) <center> <img src="{{ asset('public/images/'.$logos[0]->logo) }}" style=" width: 500px; height: 200px;"> </center> @else<span>  {{__('dashboard/news.image_not_exist')}} </span> @endif

                                        </div>


                                    </div>

                                    <div class="form-group col-sm-offset-6 col-sm-6">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/home.footer_logo')}}</label>
                                        <br>

                                        <div class="col-sm-6">
                                            <input type="file" class="form-control"  name="logo_footer">
                                        </div>

                                        <div class="col-sm-6">
                                            @if(!empty($logos[1]->logo)) <center> <img src="{{ asset('public/images/'.$logos[1]->logo) }}" style=" width: 500px; height: 200px;"> </center> @else<span>  {{__('dashboard/news.image_not_exist')}} </span> @endif

                                        </div>


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



