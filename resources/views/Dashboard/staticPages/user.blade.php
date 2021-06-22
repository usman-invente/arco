@extends('Dashboard.Layouts.RTL.layout',['title'=>__('dashboard/users.user_registration_title') ])


@section('content')


    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-light">{{__('dashboard/users.user_registration_title_description')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap col-md-12" style="color: black;">
                            <form method="POST" action="{{ route('user.registration') }}" >
                                @csrf

                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label custom_label_color text-md-right">{{ __('dashboard/user_site.data_table_title_1') }}</label>
                                            <input id="name" type="text" class="form-control custom_border @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                 </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label custom_label_color text-md-right">{{ __('dashboard/user_site.data_table_title_2') }}</label>
                                            <input id="email" type="email" class="form-control custom_border @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="nationality" class="col-form-label custom_label_color text-md-right">{{ __('dashboard/user_site.data_table_title_3') }}</label>
                                            <select type="text" class="form-control custom_border  @error('nationality_id') is-invalid @enderror" id="nationality_id"  name="nationality_id" value="{{ old('nationality_id') }}"  required>
                                                <option value=""> Please select the Nationality..</option>
                                                <option value="1"> Saudi </option>
                                                <option value="2"> Sudani </option>
                                            </select>
                                            @error('Nationality')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="contact_number" class="col-form-label custom_label_color text-md-right">{{ __('dashboard/user_site.data_table_title_4') }}</label>
                                            <input id="contact_number" type="number" class="form-control custom_border @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ old('contact_number') }}" required autocomplete="contact_number">

                                            @error('contact_number')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">


                                            <label for="qualification" class="col-form-label custom_label_color text-md-right">{{ __('dashboard/user_site.data_table_title_5') }}</label>
                                            <input id="qualification" type="text" class="form-control custom_border @error('qualification') is-invalid @enderror" name="qualification" value="{{ old('qualification') }}" required autocomplete="qualification">

                                            @error('qualification')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">


                                            <label for="address" class="col-form-label custom_label_color text-md-right">{{ __('dashboard/user_site.data_table_title_6') }}</label>
                                            <input id="address" type="text" class="form-control custom_border @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <label for="city" class="col-form-label custom_label_color text-md-right">{{ __('dashboard/user_site.data_table_title_7') }}</label>
                                            <input id="city" type="text" class="form-control custom_border @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">

                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="volunteering_field" class="col-form-label custom_label_color text-md-right">{{ __('dashboard/user_site.data_table_title_8') }}</label>
                                            <select type="text" class="form-control custom_border @error('volunteer_field_id') is-invalid @enderror" id="volunteer_field_id" name="volunteer_field_id" value="{{ old('volunteer_field_id') }}"  required="">
                                                <option value=""> Choose your desired Volunteering Field..</option>
                                                @if(!empty($volunteering_fields))
                                                    @foreach($volunteering_fields as $volunteering_field)
                                                        <option value="{{ $volunteering_field->id }}"> @if(LaravelLocalization::getCurrentLocale() === 'ar') {{$volunteering_field->field_ar}} @else {{$volunteering_field->field_en}} @endif </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('volunteer_field_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">

                                            <label for="password" class="col-form-label custom_label_color text-md-right">{{ __('dashboard/user_site.data_table_title_9') }}</label>
                                            <input id="password" type="password" class="form-control custom_border @error('password') is-invalid @enderror" name="password" required autocomplete="city">

                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="role_id" class="col-form-label custom_label_color text-md-right">{{ __('dashboard/user_site.data_table_title_11') }}</label>
                                            <select type="text" class="form-control custom_border @error('role_id') is-invalid @enderror" id="role_id" name="role_id" value="{{ old('role_id') }}"  required="">
                                                <option value=""> Choose the role of User..</option>
                                                @if(!empty($roles))
                                                    @foreach($roles as $role)
                                                        @if($role->id != \App\User::TYPE_SUPER_ADMIN)
                                                            <option value="{{ $role->id }}"> {{$role->role}}  </option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('volunteering_field')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>



                                <br><br><br>
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
    <!-- /Row -->




@endsection



