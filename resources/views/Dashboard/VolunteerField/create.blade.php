@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('admin_create_volunteer_field') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Name') }}</label>
                                    <input type="text" id="first-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.Name') }}" name="name" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.domain') }}</label>
                                    <input type="text" id="last-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.domain') }}" name="domain" value="{{old('domain')}}">
                                    @if ($errors->has('domain'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('domain') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.url') }}</label>
                                    <input type="text" id="city-column" class="form-control"   value="{{old('url')}}" placeholder="{{ __('dashboard/lang.url') }}"
                                        name="url">
                                    @if ($errors->has('url'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                        

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.picture') }}</label>
                                    <input type="file" id="city-column" class="form-control" placeholder="{{ __('dashboard/lang.picture') }}"
                                        name="image">
                                    @if ($errors->has('image'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
  
                        </div><!-- row -->
                        <div class="form-layout-footer">
                            <button class="btn btn-info">{{ __('dashboard/lang.Add') }}</button>

                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection
