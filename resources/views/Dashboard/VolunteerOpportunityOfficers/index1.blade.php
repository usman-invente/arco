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
            <section>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('admin_add_Volunteer_Opportunity_Officers')}}" class="pull-right"> <button type="button" class="btn btn-danger mr-1 mb-1">
                            <i class="feather icon-plus"></i>
                            {{__('dashboard/lang.Add Volunteer Opportunity') }}
                        </button></a>
                    </div>
                   
                  
                </div>
                <br>
                <!-- Begin Users Profile -->
                <div class="card">
                
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="vc">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>{{__('dashboard/lang.Name') }}</th>
                                        <th>{{__('dashboard/lang.Email') }}</th>
                                        <th>{{__('dashboard/lang.User Roles') }}</th>
                                        <th>{{__('dashboard/lang.Created At') }}</th>
                                        <th>{{__('dashboard/lang.Actions') }}</th>
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
{{--  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    function deleteConfirm(id) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm) {
            if (isConfirm) {
              swal("Deleted!", "Your imaginary file has been deleted.", "success");
            } else {
              swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
          });.then(function (e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'GET',
                    url: "{{url('/del-Volunteer_Supervisor')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {

                        if (results.success === true) {
                            swal("Done!", results.message, "success");
                            // toastr.success('Success!', 'Comp deleted successfully');
                                 $(".row-"+id.toString()).remove();
                        } else {
                            swal("Error!", results.message, "error");
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
 </script>  --}}
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
                    "url": "{{ route('get.Voodata') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        "data": "name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "role"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "action"
                    },
                ]
            });
        });
    </script>
@endsection


