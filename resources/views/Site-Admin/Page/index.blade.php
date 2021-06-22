@extends('layouts.app')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- User Table -->
               
​
                <!-- Begin Users Profile -->
                <div class="row">
                    <div class="col-md-8">
                        @if (session('error') || session('message'))
                <div class="alert alert-success" style="float: left; width: 100%;">
                <span class="{{ session('error') ? 'error':'success' }}">{{ session('error') ?? session('message') }}</span>
            </div>
            @endif
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('add_page')}}" class="pull-right"> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#inlineForm">
                            <i class="feather icon-plus"></i>
                            Add Page
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
                                                        <th>Title (English)</th>
                                                        <th>Title (Arabic)</th>
                                                        <th>Status</th>
                                                        <th>Updated_By</th>
                                                        <th>Updated_At</th>
                                                        <th>Action</th>
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
                "ajax": {
                    "url": "{{ route('get_page_data') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        "data": "title_en"
                    },
                    {
                        "data": "title_ar"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "name"
                    },
                     {
                        "data": "updated_at"
                    },
                    {
                        "data": "action"
                    },
                    /*{
                        "data": "action"
                    },*/
                ]
            });
        });
    </script>
@endsection
