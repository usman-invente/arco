<!DOCTYPE html>
<html lang="en">


<!-- HEAD START -->
@include('Website.Layout.head')
<!-- HEAD END -->

<body>

<!-- LOAD PAGE -->
<div class="animationload">
    <div class="loader"></div>
</div>

<!-- BACK TO TOP SECTION -->
<a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>

<!-- Navbar -->
@include('Website.Layout.navbar')
<!-- Navbar END -->





<!-- BANNER -->
<div class="section banner-page" data-background="{{ asset('public/images/pages/1614968002-min.jpg') }}">
    <div class="content-wrap pos-relative">
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <div class="title-page"> {{__('dashboard/lang.SIGN UP') }}</div>
        </div>
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}"> {{__('dashboard/lang.Home') }} </a></li>
                    <li class="breadcrumb-item active" aria-current="page"> {{__('dashboard/lang.SIGN UP') }} </li>
                </ol>
            </nav>
        </div>
    </div>
</div>





<!-- HOW TO HELP US -->
<div class="section">
    <div class="content-wrap">
        <div class="container">

            <div class="row">



                <div class=" col-sm-12 col-md-12" >
                    <div class="card promo-ads">
                        <h2 class="form-title" style="color: #1d2124;"><img src="{{asset('public/images/apple-touch-icon.png')}}"> Create Account</h2>
                        <div class="card-body content font__color-black" >

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <br>
                            <form method="POST" action="{{ route('register') }}" >
                                    @csrf

                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.Full Name') }}</label>
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
                                            <label for="email" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.Email') }}</label>
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
                                            <label for="nationality" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.Nationality') }}</label>
                                            
                                                <select type="text" class="form-control custom_border  @error('nationality') is-invalid @enderror" id="nationality"  name="nationality" value="{{ old('nationality') }}" required="">
                                                 @foreach($country as $coun)
                                                   <option value="{{$coun->id}}">{{$coun->country_en}}</option>
                                                 @endforeach
                                                   
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
                                            <label for="contact_number" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.Contact Number') }}</label>
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


                                            <label for="qualification" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.Qualification') }}</label>
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


                                            <label for="address" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.Address') }}</label>
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

                                            <label for="city" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.City') }}</label>
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
                                            <label for="volunteering_field" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.Volunteering Field') }}</label>
                                            <select type="text" class="form-control custom_border @error('volunteering_field') is-invalid @enderror" id="volunteering_field" name="volunteering_field" value="{{ old('volunteering_field') }}"  required="">
                                                @foreach( $volunteer_field as $voun)
                                                 <option value="{{$voun->id}}">{{$voun->field_en}}</option>
                                                @endforeach
                                            </select>
                                            @error('volunteering_field')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                      <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="volunteering_field" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.National Assembly') }}</label>
                                            <select type="text" class="form-control custom_border @error('organization_id') is-invalid @enderror" id="volunteering_field" name="organization_id" value="{{ old('organization_id') }}"  required="">
                                                @foreach( $organization as $orga)
                                                 <option value="{{$orga->id}}">{{$orga->name_en}}</option>
                                                @endforeach
                                            </select>
                                            @error('volunteering_field')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="password" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.Password') }}</label>
                                            <input id="password" type="password" class="form-control custom_border @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-form-label custom_label_color text-md-right">{{__('dashboard/lang.Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control custom_border" name="password_confirmation" required autocomplete="new-password">

                                        </div>
                                    </div>
                                </div>
                                <u><h3 class="custom_label_color">Attachments</h3></u>

                                <div class="row">
                                    <div class="col-sm-3 col-md-3">
                                        <div class="form-group">
                                            <label class="custom_label_color"> {{__('dashboard/lang.Personal Image') }}</label>
                                            <input type="file" class="custom_border" id="person_picture" name="person_picture" >
                                            <div class="help-block with-errors custom_error_color"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <div class="form-group">
                                            <label class="custom_label_color">  {{__('dashboard/lang.Id Photo') }}</label>
                                            <input type="file" class=" custom_border" id="id_picture" name="id_picture"  >
                                            <div class="help-block with-errors custom_error_color"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <label class="custom_label_color"> {{__('dashboard/lang.PassPort Image') }}</label>
                                        <div class="form-group">
                                            <input type="file" class=" custom_border" id="passport_picture" name="passport_picture"  >
                                            <div class="help-block with-errors custom_error_color"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <div class="form-group">
                                            <label class="custom_label_color"> {{__('dashboard/lang.CV PDF') }}</label>
                                            <input type="file" class=" custom_border" id="cv" name="cv"  >
                                            <div class="help-block with-errors custom_error_color"></div>
                                        </div>
                                    </div>
                                </div>
                                <br><br><br>
                                <div class="form-group">
                                    <div id="success"></div>

                                    <button type="submit" class="btn btn-primary pull-right">Sign-Up</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>




<style>
    .custom_border{
        border-color: #636b6f !important;
    }
    .custom_error_color{
        color: darkred; !important;
    }

    .custom_label_color{
        color: #1b1e21 !important;
    }
</style>





<!-- FOOTER SECTION -->
@include('Website.Layout.footer')
<!-- FOOTER END -->

<!-- JS VENDOR -->
@include('Website.Layout.Javascripts')
<!-- JS VENDOR -->

<script>
    function hello()
    {
        console.log("hello world");
    }

</script>

</body>
</html>
