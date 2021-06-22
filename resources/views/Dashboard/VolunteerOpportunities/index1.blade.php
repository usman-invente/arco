@extends('Dashboard.home')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- User Table -->
               

                <!-- Begin Users Profile -->
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('admin_add_Volunteer_Opportunity_Officers')}}" class="pull-right"> <button type="button" class="btn btn-danger mr-1 mb-1"  data-toggle="modal" data-target="#inlineForm">
                            <i class="feather icon-plus"></i>
                              {{__('dashboard/lang.Add Volunteer Opportunity') }}
                        </button></a>
                    </div>
                  
                </div>
                <br>
            <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"></h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <p class="card-text"></p>
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="vc">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('dashboard/lang.Topic') }}</th>
                                                        <th>{{__('dashboard/lang.Officer') }}</th>
                                                        <th>{{__('dashboard/lang.Assembly') }}</th>
                                                        <th>{{__('dashboard/lang.City') }}</th>
                                                        <th>{{__('dashboard/lang.Status') }}</th>
                                                        <th>{{__('dashboard/lang.Actions') }}</th>
                                                      
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->
                <!-- End Users Profile -->

        </div>
    </div>
</div>
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
                dom: 'Blfrtip',
               buttons: [
                    'excel', 'csv', 'pdf', 'copy'
                ],
                "ajax": {
                    "url": "{{ route('get.Mvodata') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                
                "columns": [
                    {
                        "data": "title"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "name_en"
                    },
                    {
                        "data": "city"
                    },
                    {
                        "data": "status"
                    },
                    
                    {
                        "data": "action"
                    },
                ]
            });
        });
    </script>
@endsection
