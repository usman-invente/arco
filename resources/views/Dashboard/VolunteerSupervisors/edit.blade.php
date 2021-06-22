@extends('Dashboard.home')
@section('content')
 <!-- ########## START: MAIN PANEL ########## -->
 <div class="br-mainpanel">

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
     
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
       
        <form method="POST" action="{{ route('admin_update_Volunteer_Supervisor', $Volunteer_Supervisor->id) }}" enctype="multipart/form-data">
        @csrf
            <div class="form-layout form-layout-1">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">{{__('dashboard/lang.Name') }}</label>
                <input type="text" id="first-name-column" class="form-control" placeholder="Name" name="name" value="{{$Volunteer_Supervisor->name}}">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">{{__('dashboard/lang.Email') }}</label>
                <input type="email" id="last-name-column" class="form-control" placeholder="Email" name="email" value="{{$Volunteer_Supervisor->email}}">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">{{__('dashboard/lang.Contact Number') }}</label>
                <input type="text" id="city-column" class="form-control" placeholder="{{__('dashboard/lang.Contact Number') }}" name="contact_number" value="{{$Volunteer_Supervisor->contact_number}}">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">{{ __('dashboard/lang.National Assembly') }}</label>
                  <select class="form-control" name="organization_id">
                      @foreach ($organization as $org)
                          <option @if($org->id ==$Volunteer_Supervisor->organization_id ) selected @endif value="{{$org->id}}">{{$org->name_ar}}</option>
                      @endforeach
                  </select>
                 
              </div>
          </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">{{__('dashboard/lang.Place Of Residence') }}</label>
                <input type="text" id="country-floating" class="form-control" name="address" placeholder="Place Of Residence"value="{{$Volunteer_Supervisor->address}}">
              </div>
            </div><!-- col-8 -->
            <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">{{__('dashboard/lang.Password') }}</label>
                  <input type="text" id="country-floating" class="form-control" name="password" placeholder="{{__('dashboard/lang.Password') }}" >
                </div>
            </div><!-- col-8 -->
            <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">{{__('dashboard/lang.Confirm Password') }}</label>
                  <input type="text" id="country-floating" class="form-control" name="c_password" placeholder="{{__('dashboard/lang.Confirm Password') }}" >
                </div>
            </div><!-- col-8 -->
            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">{{__('dashboard/lang.PassPort Image') }}</label>
                <input type="file" id="email-id-column" class="form-control" name="passport_picture" placeholder="Pasport Image">
                <img src="{{asset('upload/passport/'.$Volunteer_Supervisor->passport_picture)}}" height="80" width="180" style="margin-top: 10px">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">{{__('dashboard/lang.Profile Image') }}</label>
                  <input type="file" id="email-id-column" class="form-control" name="person_picture" placeholder="Email">
                  <img src="{{asset('upload/personal/'.$Volunteer_Supervisor->person_picture)}}" height="80" width="180" style="margin-top: 10px">
                </div>
              </div><!-- col-4 -->
          </div><!-- row -->

          <div class="form-layout-footer">
      
            <button class="btn btn-info">{{__('dashboard/lang.Update') }}</button>
          </div><!-- form-layout-footer -->
        </div><!-- form-layout -->
    </form>
      </div><!-- br-section-wrapper -->
    </div><!-- br-pagebody -->
@endsection