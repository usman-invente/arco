
<div class="row">
    @if(!empty($slide))
    <div class="col-sm-12" style="color: black;">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">

                        <form method="POST" action="{{ route('animatedSlides.update',$slide->id)}}" enctype="multipart/form-data">
                                {{method_field("PATCH")}}
                                @csrf

                            <div class="form-group">
                                <label class="control-label mb-10 text-left">{{__('dashboard/animatedSlides.data_table_title_1')}}</label>
                                <input type="text" class="form-control"  name="name" value="{{$slide->name}}" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">{{__('dashboard/animatedSlides.data_table_title_2')}}</label>
                                <input type="file" name="image"  >
                                @if(!empty($slide->image)) <center> <img src="{{ asset('public/images/animatedSlides/'.$slide->image) }}" style=" width: 300px; height: 200px;"> </center> @else<span>  {{__('dashboard/news.image_not_exist')}} </span> @endif

                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">{{__('dashboard/animatedSlides.data_table_title_4')}}</label>
                                <input type="text" class="form-control"  name="sequence" value="{{$slide->sequence}}" required>
                            </div>
                            <div class="form-group mt-30 mb-30">
                                <label class="control-label mb-10 text-left">{{__('dashboard/animatedSlides.data_table_title_3')}}</label>
                                <select name="status_id" placeholder="Select ..." class="form-control" required>

                                    @foreach($activeStatus as $Status)
                                        <option value="{{$Status->id}}" @if ($Status->id==$slide->status_id){{"  selected " }}:{{""}} @endif>{{$Status->status}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <h1>NOT FOUND </h1>
    @endif

</div>

