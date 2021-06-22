@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">

                <form method="POST" action="{{ route('update_animated_slide', $data->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Name') }}</label>
                                    <input type="text" id="first-name-column" class="form-control @error('name') is-invalid @enderror" value="{{ $data->name }}" placeholder="Name" name="name">
                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first-name-column">{{__('dashboard/lang.Sequence') }}</label>
                                    <input type="number" id="first-name-column" class="form-control @error('sequence') is-invalid @enderror" value="{{ $data->sequence }}" placeholder="Sequence" name="sequence">
                                          
                                </div>
                            </div><!-- col-4 -->

                                     
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Status') }}</label>
                                    <select class="form-control" id="basicSelect" name="status_id">
                                        <option value="1">Active</option>
                                        <option value="2">Deacive</option>
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.slide text') }}</label>
                                    <input type="text" id="email-id-column" class="form-control"  value="{{$data->slide_text}}" name="slide_text" required>
                                 
                                
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.sub text') }}</label>
                                    <input type="text" id="email-id-column" class="form-control"   value="{{$data->sub_text}}"  name="sub_text" required>
                                     
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.topic') }}</label>
                                    <select class="form-control" id="topic" name="topic" required >
                                        <option  @if($data->topic=="Searchbar") selected @endif value="Searchbar">Searchbar</option>
                                        <option  @if($data->topic=="CountDown") selected @endif value="CountDown">CountDown</option>
                                    </select>
                                    <br><br>
                                    <p>{{__('dashboard/lang.Enter No of days you want to run counter') }}</p>
                                    <input type="date" id="count_field" class="form-control"   name="no_of_days" >
                                    
                                </div>
                            </div><!-- col-4 -->



                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('dashboard/lang.Image') }}</label>
                                    <input type="file" id="email-id-column" class="form-control"value="" name="image">
                                    <img src="{{asset('public/upload/Animated-Slide/'.$data->image)}}" height="80" width="180" style="margin-top: 10px">
                                
                                </div>
                            </div><!-- col-4 -->

                      

      
                        </div><!-- row -->
                        <div class="form-layout-footer">
                            <button   value="save" class="btn btn-info">{{ __('dashboard/lang.Update') }}</button>
                           
                          

                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
                {{-- <form method="post"  action="{{ route('site_public_news') }}">
                    <button class="btn btn-info">{{ __('dashboard/lang.Preview') }}</button>
                </form> --}}
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection

@section('script')
<script>
$("#topic").change(function () {
    var val = this.value;
    if(val == "CountDown"){
        $("#coun_field").show();
    }else{
        $("#coun_field").hide();
    }
});
</script>

@endsection
