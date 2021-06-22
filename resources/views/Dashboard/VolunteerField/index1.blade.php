@extends('Dashboard.home')


@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin_add_volunteer_field')}}" class="pull-right"> <button type="button" class="btn btn-danger mr-1 mb-1">
                        <i class="feather icon-plus"></i>
                         {{__('dashboard/lang.Add Volunteer Fields') }}
                    </button></a>
                </div>
              
            </div>
            <br>
            <!-- User Table -->
            <section>
               

                <!-- Begin Users Profile -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="vc">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th> {{__('dashboard/lang.Field Name (English)') }}</th>
                                        <th> {{__('dashboard/lang.Field Name (Arabic)') }}</th>
                                        <th> {{__('dashboard/lang.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Users Profile -->
            </section>

        </div>
    </div>
</div>
{{--  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>  --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#vc').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'ALL' ]
                ],
                "ajax": {
                    "url": "{{ route('get.Aovpdata') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                dom: 'Blfrtip',
               buttons: [
                    'excel', 'csv', 'pdf', 'copy'
                ],
                "columns": [{
                        "data": "field_en"
                    },
                    {
                        "data": "field_ar"
                    },
                    {
                        "data": "action"
                    },
                ]
            });
        });
    </script>
@endsection
