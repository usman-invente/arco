@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('site_create_news') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Address') }}</label>
                                    <input class="form-control @error('description') is-invalid @enderror" name="address" id="basicTextarea" >
                                
                                    @if ($errors->has('address'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
    
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Assembly') }}</label>
                                   <select class="form-control" name="organization_id">
                                       @foreach($organizations as $organization)
                                       <option value="{{$organization->id}}"> {{$organization->name_en}}</option>
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
                                <div class="form-group">
                                    <label for="inputPassword">{{__('dashboard/lang.Status') }}</label>
                                    <select class="form-control" id="basicSelect" name="status_id">
                                        <option value="1">Published</option>
                                        <option value="2">Not Published</option>
                                    </select>
                                   
                                
                                 
                                </div>
                            </div><!-- col-4 -->

                                     
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Description') }}</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror summernote" name="description" id="basicTextarea" rows="3" ></textarea>
                                    @if ($errors->has('description'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Image') }}</label>
                                    <input type="file" id="email-id-column" class="form-control"value="" name="image">
                                
                                </div>
                            </div><!-- col-4 -->
      
                        </div><!-- row -->
                        <input type="hidden" name="status_id" value="1">
                        <div class="form-layout-footer">
                            <button  name="action" value="save" class="btn btn-info">{{ __('dashboard/lang.Add') }}</button>
                            <button  name="action" value="preview" class="btn btn-info">{{ __('dashboard/lang.Preview') }}</button>
                          

                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
                {{-- <form method="post"  action="{{ route('site_public_news') }}">
                    <button class="btn btn-info">{{ __('dashboard/lang.Preview') }}</button>
                </form> --}}
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection
