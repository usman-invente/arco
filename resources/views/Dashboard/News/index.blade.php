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
               

                <!-- Begin Users Profile -->
                <div class="row">
                    <div class="col-md-12">
                        <a   href="{{route('admin_add_news')}}"  class="pull-right"> <button type="button"   class="btn btn-success mr-1 mb-1">
                            <i class="feather icon-plus"></i>
                             {{__('dashboard/lang.Add News') }}
                        </button></a>
                            <a href="#" id="delete_record" class="pull-right"> <button type="button"
                                class="btn btn-danger mr-1 mb-1">
                                <i class="feather icon-trash"></i>
                                {{ __('dashboard/lang.Delete') }}
                            </button></a>
                    </div>
                  
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        <div class="user-actions">
                            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Add User</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                    <th><input type="checkbox" class='checkall' id='checkall'></th>
                                                    <th>{{__('dashboard/lang.Name') }}</th>
                                                    <th>{{__('dashboard/lang.Description') }}</th>
                                                    <th>{{__('dashboard/lang.Status') }}</th>
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
                            </div>
                        </div>
                    </div>
                     </div>
                </section>
                <!-- End Users Profile -->
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
                 lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'ALL' ]
                ],
                
                order: [
                    [1, "desc"]
                ],
                 dom: 'Blfrtip',
               buttons: [
                    'excel', 'csv', 'pdf', 'copy'
                ],
                "ajax": {
                    "url": "{{ route('get.Newsdata') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                "columns": [
                     {
                        "data": "checkbox",
                        'orderable': false
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "description"
                    },
                    {
                        "data": "status"
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
                            url: "{{ route('deletenews') }}",
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
