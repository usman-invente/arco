
<div class="row">
    <div class="col-sm-12" style="color: black;">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">
                        <form method="POST" action="{{ route('animatedSlides.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="control-label mb-10 text-left">{{__('dashboard/animatedSlides.data_table_title_1')}}</label>
                                <input type="text" class="form-control"  name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">{{__('dashboard/animatedSlides.data_table_title_2')}}</label>
                                <input type="file" id="image"  name="image" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">{{__('dashboard/animatedSlides.data_table_title_4')}}</label>
                                <input type="text" class="form-control"  name="sequence" required>
                            </div>
                            <div class="form-group mt-30 mb-30">
                                <label class="control-label mb-10 text-left">{{__('dashboard/animatedSlides.data_table_title_3')}}</label>
                                <select name="status_id" placeholder="Select ..." class="form-control" required>

                                    @foreach($activeStatus as $Status)
                                        <option value="{{$Status->id}}" >{{$Status->status}}</option>
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
</div>

