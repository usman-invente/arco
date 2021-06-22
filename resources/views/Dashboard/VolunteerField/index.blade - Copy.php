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
                    <a href="{{route('admin_add_volunteer_field')}}" class="pull-right"> <button type="button" class="btn btn-success mr-1 mb-1">
                        <i class="feather icon-plus"></i>
                         {{__('dashboard/lang.Add Volunteer Fields') }}
                    </button></a>
                    <a href="#" id="delete_record" class="pull-right"> <button type="button"
                        class="btn btn-danger mr-1 mb-1">
                        <i class="feather icon-trash"></i>
                        {{ __('dashboard/lang.Delete') }}
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
                                        <th><input type="checkbox" class='checkall' id='checkall'></th>
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
                    [1, "desc"]
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
                    "url": "{{ route('get.Aovpdata') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                "columns": [
                    {
                        "data": "checkbox",
                        "orderable": false,
                    },
                    {
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
           // Check all 
           $('#checkall').click(function(){
            if($(this).is(':checked')){
                $('.delete_check').prop('checked', true);
            }else{
                $('.delete_check').prop('checked', false);
            }
        });
        // Delete record
        $('#delete_record').click(function() {
            var deleteids_arr = [];
            // Read all checked checkboxes
            $("input:checkbox[class=delete_check]:checked").each(function() {
                deleteids_arr.push($(this).val());
            });

            // Check checkbox checked or not
            if (deleteids_arr.length > 0) {

                swal({
                    title: "Are you sure?",
                    text: "Please ensure and then confirm!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: !0
                }).then(function(e) {

                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            url: "{{ route('deletevolunterfield') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                deleteids_arr: deleteids_arr
                            },
                            success: function(response) {
                                $('#vc').DataTable().ajax.reload();
                            }
                        });

                    } else {
                        e.dismiss;
                    }

                }, function(dismiss) {
                    return false;
                })

            }
        });

                // Checkbox checked
        function checkcheckbox(){

        // Total checkboxes
        var length = $('.delete_check').length;

        // Total checked checkboxes
        var totalchecked = 0;
        $('.delete_check').each(function(){
        if($(this).is(':checked')){
            totalchecked+=1;
        }
        });

        // Checked unchecked checkbox
        if(totalchecked == length){
        $("#checkall").prop('checked', true);
        }else{
        $('#checkall').prop('checked', false);
        }
        }

    </script>
@endsection
