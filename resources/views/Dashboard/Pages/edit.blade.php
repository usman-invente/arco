@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('update_page',$data->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Address') }}</label>
                                    <input class="form-control @error('description') is-invalid @enderror" value="{{$data->title_en}}" name="title_en" id="basicTextarea" >
                                
                                 
                                </div>
                            </div><!-- col-4 -->
    
                       

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="inputPassword">{{__('dashboard/lang.Status') }}</label>
                                    <select class="form-control" id="basicSelect" name="status_id" >
                                        <option @if($data->status_id == 1) selected @endif value="1">Published</option>
                                        <option  @if($data->status_id == 2) selected @endif value="2">Not Published</option>
                                    </select>
                                   
                                
                                 
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="inputPassword">{{__('dashboard/lang.select menu position') }}</label>
                                    <select class="form-control" id="basicSelect" name="is_menu_bar" >
                                        <option @if($data->status_id == 1) selected @endif  value="1">Top Menu</option>
                                        <option   @if($data->status_id == 2) selected @endif value="2">Footer</option>
                                    </select>
                                   
                                
                                 
                                </div>
                            </div><!-- col-4 -->

                                     
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Description') }}</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror summernote" name="content" id="basicTextarea" rows="3" required >{{$data->content}}</textarea>
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
                                    <input type="file" id="email-id-column" class="form-control" name="page_image"  >
                                    <img src="{{asset('public/upload/page_image/'.$data->page_image)}}" height="80" width="180" style="margin-top: 10px">
                                </div>
                            </div><!-- col-4 -->
      
                        </div><!-- row -->
                        <input type="hidden" name="status_id" value="1">
                        <div class="form-layout-footer">
                            <button   class="btn btn-info">{{ __('dashboard/lang.Update') }}</button>
                         
                          

                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
                {{-- <form method="post"  action="{{ route('site_public_news') }}">
                    <button class="btn btn-info">{{ __('dashboard/lang.Preview') }}</button>
                </form> --}}
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection
