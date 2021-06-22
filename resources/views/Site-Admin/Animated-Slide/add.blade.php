@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('create_animated_slide') }}" 
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Name') }}</label>
                                    <input type="text" id="first-name-column" class="form-control @error('name') is-invalid @enderror"  placeholder="Name" name="name" required>
                                </div>
                            </div><!-- col-4 -->
               

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.Sequence') }}</label>
                                    <input type="number" id="first-name-column" class="form-control @error('sequence') is-invalid @enderror" placeholder="Sequence" name="sequence" required>
                                          
                                </div>
                            </div><!-- col-4 -->

                                     
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Status') }}</label>
                                    <select class="form-control" id="basicSelect" name="status_id" required >
                                        <option value="1">Active</option>
                                        <option value="2">Deacive</option>
                                    </select>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.slide text') }}</label>
                                    <input type="text" id="email-id-column" class="form-control"  name="slide_text" required>
                                 
                                
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.sub text') }}</label>
                                    <input type="text" id="email-id-column" class="form-control"  name="sub_text" required>
                                     
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Image') }}</label>
                                    <input type="file" id="email-id-column" class="form-control"  name="image" required>
                                 
                                
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.topic') }}</label>
                                    <select class="form-control" id="basicSelect" name="topic" required >
                                        <option value="Searchbar">Searchbar</option>
                                        <option value="CountDown">CountDown</option>
                                    </select>
                                 
                                
                                </div>
                            </div><!-- col-4 -->

                           
      
                        </div><!-- row -->
                        <div class="form-layout-footer">
                            <button   value="save" class="btn btn-info">{{ __('dashboard/lang.Add') }}</button>
                           
                          

                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
                {{-- <form method="post"  action="{{ route('site_public_news') }}">
                    <button class="btn btn-info">{{ __('dashboard/lang.Preview') }}</button>
                </form> --}}
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection
