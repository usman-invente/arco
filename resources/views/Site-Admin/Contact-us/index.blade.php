@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('create_call_us') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="first-name-column">{{ __('dashboard/lang.Assembly') }}</label>
                                    <select class="form-control" name="organization_id">
                                        @foreach($organization as $org)

                                        <option  @if($org->id  == $call->organization_id) selected @endif  value="{{$org->id}}">{{$org->name_ar}}</option>
                                        @endforeach()
                                        

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="first-name-column">{{ __('dashboard/lang.Main Addres') }}</label>
                                    <input type="text" id="first-name-column"
                                        class="form-control @error('main_address') is-invalid @enderror"
                                        placeholder="Addres" name="main_address" value="{{ $call->main_address ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="radio" id="first-name-column" @if ($call->main_address_checkbox == 1) checked @endif
                                        style="margin-top: 40px;" name="main_address_checkbox" value="1"> Show
                                    <input type="radio" id="first-name-column" @if ($call->main_address_checkbox == 0) checked @endif
                                        style="margin-top: 40px;" name="main_address_checkbox" value="0"> Hide
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="first-name-column">{{ __('dashboard/lang.Second Addres') }}</label>
                                    <input type="text" id="first-name-column"
                                        class="form-control @error('second_address') is-invalid @enderror"
                                        placeholder="Second Addres" name="second_address"
                                        value="{{ $call->second_address ?? '' }}">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="radio" id="first-name-column" @if ($call->second_address_checkbox == 1) checked @endif style="margin-top: 40px;" name="second_address_checkbox" value="1"> Show
                                    <input type="radio" id="first-name-column" @if ($call->second_address_checkbox == 0) checked @endif style="margin-top: 40px;" name="second_address_checkbox" value="0"> Hide
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="first-name-column">{{ __('dashboard/lang.phone') }}</label>
                                    <input type="text" id="first-name-column"
                                        class="form-control @error('main_phone') is-invalid @enderror" placeholder="Phone"
                                        name="main_phone" value="{{ $call->main_phone ?? '' }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="radio" id="first-name-column" @if ($call->main_phone_checkbox == 1) checked @endif
                                        style="margin-top: 40px;" name="main_phone_checkbox" value="1"> Show
                                    <input type="radio" id="first-name-column" @if ($call->main_phone_checkbox == 0) checked @endif
                                        style="margin-top: 40px;" name="main_phone_checkbox" value="0"> Hide
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group mg-b-10-force">
                                    <label for="first-name-column">{{ __('dashboard/lang.Second Phone') }}</label>
                                    <input type="text" id="first-name-column"
                                        class="form-control @error('second_phone') is-invalid @enderror"
                                        placeholder="Scond Phone" name="second_phone"
                                        value="{{ $call->second_phone ?? '' }}">
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="radio" id="first-name-column" @if ($call->second_phone_checkbox == 1) checked @endif
                                        style="margin-top: 40px;" name="second_phone_checkbox" value="1"> Show
                                    <input type="radio" id="first-name-column" @if ($call->second_phone_checkbox == 0) checked @endif
                                        style="margin-top: 40px;" name="second_phone_checkbox" value="0"> Hide
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group mg-b-10-force">
                                    <label for="first-name-column">{{ __('dashboard/lang.Email') }}</label>
                                    <input type="email" id="first-name-column"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                        name="email" value="{{ $call->email ?? '' }}">
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="radio" id="first-name-column" @if ($call->email_checkbox == 1) checked @endif
                                        style="margin-top: 40px;" name="email_checkbox" value="1"> Show
                                    <input type="radio" id="first-name-column" @if ($call->email_checkbox == 0) checked @endif
                                        style="margin-top: 40px;" name="email_checkbox" value="0"> Hide
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group mg-b-10-force">
                                    <label for="first-name-column">{{ __('dashboard/lang.Second Email') }}</label>
                                    <input type="text" id="first-name-column"
                                        class="form-control @error('second_email') is-invalid @enderror"
                                        placeholder="Addres" name="second_email" value="{{ $call->second_email ?? '' }}">
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="radio" id="first-name-column" @if ($call->second_email_checkbox == 1) checked @endif
                                        style="margin-top: 40px;" name="second_email_checkbox" value="1"> Show
                                    <input type="radio" id="first-name-column" @if ($call->second_email_checkbox == 0) checked @endif
                                        style="margin-top: 40px;" name="second_email_checkbox" value="0"> Hide
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group mg-b-10-force">
                                    <label for="first-name-column">{{ __('dashboard/lang.location') }}</label>
                                    <br>
                                    <b>You can follow this link to embed maps <br>
                                        <a target="_blank"
                                            href="https://support.google.com/maps/answer/144361?co=GENIE.Platform%3DDesktop&hl=en#:~:text=Embed%20a%20map%20or%20directions&text=the%20embedded%20map.-,Open%20Google%20Maps.,Click%20Embed%20map."><mark>Click
                                                here</mark></a></b>
                                    <br><br>
                                    <input type="text" id="first-name-column"
                                        class="form-control @error('location') is-invalid @enderror" placeholder="Location"
                                        name="location" value="{{ $call->location ?? '' }}">


                                </div>
                            </div><!-- col-4 -->
                            <br>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <br><br>
                                    <input type="radio" id="first-name-column" @if ($call->location_checkbox == 1) checked @endif
                                        style="margin-top: 40px;" name="location_checkbox" value="0"> Show
                                    <input type="radio" id="first-name-column" @if ($call->location_checkbox == 0) checked @endif
                                        style="margin-top: 40px;" name="location_checkbox" value="0"> Hide
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group mg-b-10-force">
                                    <label for="first-name-column">{{ __('dashboard/lang.time') }}</label>
                                    <input type="text" id="first-name-column"
                                        class="form-control @error('time') is-invalid @enderror" placeholder="Time"
                                        name="time" value="{{ $call->time ?? '' }}">
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="radio" id="first-name-column" @if ($call->time_checkbox == 1) checked @endif
                                        style="margin-top: 40px;" name="time_checkbox" value="1"> Show
                                    <input type="radio" id="first-name-column" @if ($call->time_checkbox == 0) checked @endif
                                        style="margin-top: 40px;" name="time_checkbox" value="0"> Hide
                                </div>
                            </div>
                        </div><!-- row -->

                        <div class="form-layout-footer">

                            <button class="btn btn-info">{{ __('dashboard/lang.Update') }}</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
    @endsection
