@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('admin_create_Volunteer_Supervisor') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Name') }}</label>
                                    <input type="text" id="first-name-column" class="form-control"
                                        placeholder="{{ __('dashboard/lang.Name') }}" name="name">
                                    @if ($errors->has('name'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{ __('dashboard/lang.Email') }}</label>
                                    <input type="email" id="last-name-column" class="form-control"
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
                                    <label class="form-control-label">{{ __('dashboard/lang.Contact Number') }}</label>
                                    <input type="text" id="city-column" class="form-control" placeholder="Contact Number"
                                        name="contact_number">
                                    @if ($errors->has('contact_number'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('contact_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                              <div class="form-group">
                                  <label class="form-control-label">{{ __('dashboard/lang.National Assembly') }}</label>
                                  <select class="form-control" name="organization_id">
                                      @foreach ($organizations as $org)
                                          <option value="{{$org->id}}">{{$org->name_ar}}</option>
                                      @endforeach
                                  </select>
                                  @if ($errors->has('organization_id'))
                                      <span class="error" role="alert">
                                          <strong>{{ $errors->first('organization_id') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">{{ __('dashboard/lang.Place Of Residence') }}</label>
                                    <input type="text" id="country-floating" class="form-control" name="address"
                                        placeholder="Place Of Residence">
                                    @if ($errors->has('address'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">{{ __('dashboard/lang.Password') }}</label>
                                    <input type="text" id="country-floating" class="form-control" name="password"
                                        placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">{{ __('dashboard/lang.Confirm Password') }}</label>
                                    <input type="text" id="country-floating" class="form-control"
                                        name="password_confirmation" placeholder="Confirm Password">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-8 -->
           
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">{{ __('dashboard/lang.PassPort Image') }}</label>
                                    <input type="file" id="email-id-column" class="form-control" name="passport_picture">
                                    @if ($errors->has('passport_picture'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('passport_picture') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div><!-- col-4 -->
                 
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">{{ __('dashboard/lang.Profile Image') }}</label>
                                    <input type="file" id="email-id-column" class="form-control" name="person_picture">
                                    @if ($errors->has('person_picture'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('person_picture') }}</strong>
                                        </span>
                                    @endif


                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->
                        <input type="hidden" name="role_id" value="3">
                        <div class="form-layout-footer">
                            <button class="btn btn-info">{{ __('dashboard/lang.Add') }}</button>

                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
    @endsection
