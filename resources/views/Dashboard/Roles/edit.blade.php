
<div class="row">
    @if(!empty($role))

{{--        <legend> Role: {{ $role->role }}</legend>--}}
        <div class="col-sm-12" style="color: black;">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form method="POST" action="{{ route('roles.update',$role->id)}}" enctype="multipart/form-data">
                                {{method_field("PATCH")}}
                                @csrf

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label mb-10 text-left">{{__('dashboard/volunteers.data_table_title_6')}}</label>
                                        <input type="text" class="form-control" name="role" id="role" value="{{ $role->role }}" required>
                                    </div>
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

