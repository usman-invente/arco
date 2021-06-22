@extends('Dashboard.home')
@section('content')
 <!-- ########## START: MAIN PANEL ########## -->
 <div class="br-mainpanel">

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
     
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
       
        <form method="POST" action="{{ route('create_counter') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-layout form-layout-1">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
              <label class="form-control-label">{{__('dashboard/lang.Counters') }}</label>
                <select class="form-control" id="basicSelect" name="data_selection">
                    <option @if($counter->data_selection =="Fixed") selected @endif value="Fixed">Fixed</option>
                    <option @if($counter->data_selection =="Database") selected @endif value="DataBase">DataBase</option>
                </select>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">{{__('dashboard/lang.Number Of Volunteers') }}</label>
                <input type="number" id="email-id-column" class="form-control @error('no_of_volunteer') is-invalid @enderror" name="no_of_volunteer" placeholder="Number Of Volunteer" value="{{ $counter->no_of_volunteer ?? ''}}"> 
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">{{__('dashboard/lang.Number Of Volunteer Opportunities') }}</label>
                <input type="number" id="email-id-column" class="form-control @error('no_of_volunteer_opportunities') is-invalid @enderror" name="no_of_volunteer_opportunities" placeholder="Number Of Volunteer Opportunities" value="{{ $counter->no_of_volunteer_opportunities ?? ''}}">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">{{__('dashboard/lang.Number Of Volunteer Hours') }}</label>
                <input type="number" id="last-name-column" class="form-control @error('no_of_volunteer_hours') is-invalid @enderror" placeholder="Number Of Volunteer Hours" name="no_of_volunteer_hours" value="{{ $counter->no_of_volunteer_hours ?? ''}}">
              </div>
            </div><!-- col-8 -->
            <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  
                </div>
            </div><!-- col-8 -->
            <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                 
                </div>
            </div><!-- col-8 -->
            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">

               
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  
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