@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('admin_create_organization') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Name') }}</label>
                                    <input type="text" id="first-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.Name') }}" name="name_en">
                                    @if ($errors->has('name_en'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('name_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Supervisor Name') }}</label>
                                    <input type="text" id="first-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.Supervisor Name') }}" name="supervisor_name">
                                    @if ($errors->has('supervisor_name'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('supervisor_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Email') }}</label>
                                    <input type="text" id="first-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.Email') }}" name="email">
                                    @if ($errors->has('email'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Password') }}</label>
                                    <input type="text" id="first-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.Password') }}" name="password">
                                    @if ($errors->has('password'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Contact Number') }}</label>
                                    <input type="text" id="first-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.Contact Number') }}" name="contact">
                                    @if ($errors->has('contact'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('contact') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.url') }}</label>
                                    <input type="text" id="first-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.url') }}" name="site_url">
                                    @if ($errors->has('site_url'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('site_url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Logo Image') }}</label>
                                    <input type="file" id="first-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.Logo Image') }}" name="logo">
                                    @if ($errors->has('logo'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('logo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                           
                            
                            <div class="col-lg-12">
                                <div class="form-layout-footer">
                                    <button class="btn btn-info">{{ __('dashboard/lang.Add') }}</button>
        
                                </div><!-- form-layout-footer -->
                            </div><!-- col-4 -->
                      
         
                    </div><!-- form-layout -->
                </form>
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection
