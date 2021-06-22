@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{route('admin_update_account',Auth::user()->id)}}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                         

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.Name') }} </label>
                                    <input type="text" id="first-name-column" class="form-control" placeholder=" Name " value="{{$user->name}}" name="name">
                                    
                                    
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column"> {{__('dashboard/lang.Roll') }} </label>
                                    <input type="text" id="first-name-column" class="form-control"  value="{{$user->role}}" >
                                      
                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.Contact Number') }} </label>
                                    <input type="text" id="first-name-column" class="form-control" placeholder="Contact Number"value="{{$user->contact_number}}" name="contact_number">
                                       
                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.Email') }}</label>
                                    <input type="email" id="first-name-column" class="form-control" placeholder="Email"value="{{$user->email}}" name="email">
                                                              
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.Assembly') }} </label>
                                    <select class="form-control @error('organization_id') is-invalid @enderror" id="basicSelect" name="organization_id">
                                                    
                                        @foreach($organizations as $orga)
                                        <option value="{{$orga->id}}">{{$orga->name_en}}</option>
                                        @endforeach
                                    </select>
                                    
                                    
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.the field of volunteer you desire') }} </label>
                                    <select class="form-control @error('volunteer_field_id') is-invalid @enderror" id="basicSelect" name="volunteer_field_id">
                                                    
                                        @foreach( $volunteringfiled as $voun)
                                        <option value="{{$voun->id}}">{{$voun->field_en}}</option>
                                        @endforeach
                                    </select>
                                    
                                    
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.Place Of Residence') }}</label>
                                    <input type="text" id="first-name-column" class="form-control" placeholder="Place of Residence" value="{{$user->address}}" name="address">
                                  
                                    
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.City') }}</label>
                                    <input type="text" id="first-name-column" class="form-control" placeholder="City" value="{{$user->city}}" name="city">                 
                                    
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.iden_no') }}</label>
                                    <input type="text" id="first-name-column" class="form-control" value="{{$user->identification_no}}" name="identification_no">       
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.age') }}</label>
                                    <input type="text" id="first-name-column" class="form-control" placeholder="Age" value="{{$user->age}}" name="age">
                       
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.qualification') }}</label>
                                    <input type="text" id="first-name-column" class="form-control"  value="{{$user->qualification}}" name="qualification">
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email-id-column">{{__('dashboard/lang.sex') }}</label>
                                    <select class="form-control" name="sex">
                                        <option  @if($user->sex == "male") selected @endif value="male">Male</option>       
                                        <option @if($user->sex == "female") selected @endif value="female">Female</option>
                                    </select>
                                </div>
                            </div><!-- col-4 -->

                        
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email-id-column">{{__('dashboard/lang.Password') }}</label>
                                    <input type="text" id="email-id-column" class="form-control" name="password" >
 
                                                           
                                </div>
                            </div><!-- col-4 -->

                          

                      

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email-id-column">{{__('dashboard/lang.CV PDF') }}</label>
                                    <input type="file" id="email-id-column" class="form-control" name="cv">
                                    @if($user->cv)
                                    <div class="col-md-6 col-12">
                                        <a style="color:black;font-weight: bold;" href="{{asset('public/upload/cv/'.$user->cv)}}"><u>Download CV</u></a>
                                     </div>
                                   @endif                     
                                                      
                                   
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email-id-column">{{__('dashboard/lang.Personal Image') }}</label>
                                    <input type="file" id="email-id-column" class="form-control"value="" name="person_picture" placeholder="Personal Image">
                                    <img src="{{asset('upload/personal/'.$user->person_picture)}}" style="margin-top: 10px;width:200px;height:200px">
                                    
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email-id-column">{{__('dashboard/lang.PassPort Image') }}</label>
                                    <input type="file" id="email-id-column" class="form-control"value="" name="passport_picture" placeholder="PassPort Image">
                                    <img src="{{asset('upload/passport/'.$user->passport_picture)}}" height="80" width="180" style="margin-top: 10px;width:200px;height:200px">
                                    
                                </div>
                            </div><!-- col-4 -->
                           
                            
                            <div class="col-lg-12">
                                <div class="form-layout-footer">
                                    <button class="btn btn-info">{{ __('dashboard/lang.Update') }}</button>
        
                                </div><!-- form-layout-footer -->
                            </div><!-- col-4 -->
                      
         
                    </div><!-- form-layout -->
                </form>
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection
