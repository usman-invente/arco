@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('create_page') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Address') }}</label>
                                    <input class="form-control @error('description') is-invalid @enderror" name="title_en" id="basicTextarea" >
                                
                                    @if ($errors->has('title_en'))
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('title_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><!-- col-4 -->
    
                       

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="inputPassword">{{__('dashboard/lang.Status') }}</label>
                                    <select class="form-control" id="basicSelect" name="status_id" required>
                                        <option value="1">Published</option>
                                        <option value="2">Not Published</option>
                                    </select>
                                   
                                
                                 
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="inputPassword">{{__('dashboard/lang.select menu position') }}</label>
                                    <select class="form-control" id="basicSelect" name="is_menu_bar" required>
                                        <option value="1">Top Menu</option>
                                        <option value="2">Footer</option>
                                    </select>
                                   
                                
                                 
                                </div>
                            </div><!-- col-4 -->

                                     
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Description') }}</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror summernote" name="content" id="basicTextarea" rows="3" required ></textarea>
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
                                    <input type="file" id="email-id-column" class="form-control"value="" name="page_image" >
                                
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
