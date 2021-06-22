@extends('Dashboard.Layouts.RTL.layout',['title'=>__('dashboard/volunteers.users_title') ])


@section('content')




    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-light">{{__('dashboard/volunteers.users_title_description')}}</h6>
                    </div>
                    <div class="pull-right">
                        <h2><a href="javascript:add();" class="btn-primary btn"><i class="fa fa-plus" ></i> {{__('dashboard/volunteers.users_add_button')}}</a>
                        </h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive" style="color: black;">
                                <table id="datable_1" class="table table-bordered table-striped table-hover  display  pb-30"  >
                                    <thead>
                                    <tr>
                                        <th>{{__('dashboard/volunteers.data_table_title_1')}}</th>
                                        <th>{{__('dashboard/volunteers.data_table_title_2')}}</th>
                                        <th>{{__('dashboard/volunteers.data_table_title_6')}}</th>
                                        <th>{{__('dashboard/volunteers.data_table_title_3')}}</th>
                                        <th>{{__('dashboard/volunteers.data_table_title_4')}}</th>
                                        <th>{{__('dashboard/volunteers.data_table_title_5')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody >
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content"  style="width: 800px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h5 class="modal-title" id="exampleModalLabel1">{{__('dashboard/volunteers.users_title_description')}}</h5>
                            </div>

                            <div style="width:100%;clear:both;" id="loader_id"><center> <img src="{{ asset('public/ajaxloader.gif')}}" style=" width: 80px; height: 80px;"> </center>  </div>


                            <div class="modal-body"  id="response" style="display: none;">
                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- /Row -->

    <script>


        $(document).ready(function(){

            fill_datatable();

            function fill_datatable()
            {
                var dataTable = $('#datable_1').DataTable({
                    //searching: false,
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    dom: 'lBfrtip',
                    "buttons": [
                        {
                            extend: 'excel',
                            text: 'Export to Excel',
                            exportOptions: {

                                modifier: {
                                    search: 'applied',
                                    order: 'applied'
                                }
                            }
                        }
                    ],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    "pagingType": "full_numbers",
                    "autoWidth": false,
                    "drawCallback": function( settings ) {
                        $('[data-toggle="tooltip"]').tooltip();
                    },
                    ajax:{
                        url: "{{ route('users.index') }}",

                    },

                    columns: [
                        {
                            data:'name',
                            name:'name',
                            //visible:false
                        },
                        {
                            data:'email',
                            name:'email'
                        },
                        {
                            data:'role',
                            name:'role'
                        },
                        {
                            data:'name_en',
                            name:'name_en'
                        },
                        {
                            data:'status',
                            name:'status'
                        },
                        {
                            "orderable": false,
                            className: "dt-nowrap",
                            "targets": -1,
                            //"data": 'id',
                            "render": function (data, type, row, meta) {
                                return '<input id="name_'+row.id+'" type="hidden" value="'+row.name+'">'+
                                    '<a id='+row.id+' data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn-primary btn menu-icon vd_bd-yellow vd_yellow edit"> <i class="fa fa-pencil"></i> </a>'+
                                    '&nbsp;<a id='+row.id+' data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn-primary btn menu-icon vd_bd-red vd_red delete"> <i class="fa fa-times"></i> </a>'+
                                    '&nbsp;<a id='+row.id+' data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn-primary btn menu-icon vd_bd-green vd_green view"> <i class="fa fa-eye"></i> </a>'
                            }
                        }

                    ]
                });

            }


            $('#datable_1 tbody').on( 'click', '.view', function (e) {
                e.preventDefault();
                $("#exampleModal").modal();
                document.getElementById('loader_id').style.display = 'block';
                var id = $(this).attr('id');
                //console.log("attribute ID:"+id);


                document.getElementById('response').style.display = 'none';


                $.ajax({
                    type: 'GET',
                    url: "{{URL('/dashboard/users')}}"+"/"+id,
                    contentType: "html",
                    dataType : 'html',
                    success: function (data) {
                        //console.log(data);
                        document.getElementById('response').style.display = 'block';
                        document.getElementById('response').innerHTML=data;
                        document.getElementById('loader_id').style.display = 'none';

                    }
                });
            } );


            $('#datable_1 tbody').on('click', '.edit', function (e) {
                e.preventDefault();
                $("#exampleModal").modal();
                document.getElementById('loader_id').style.display = 'block';
                var id = $(this).attr('id');
                //console.log("attributessssss ID:"+id);


                document.getElementById('response').style.display = 'none';


                $.ajax({
                    type: 'GET',
                    url: "{{URL('/dashboard/users')}}" + "/" + id + "/edit",
                    contentType: "html",
                    dataType: 'html',
                    success: function (data) {

                        document.getElementById('response').innerHTML = data;
                        document.getElementById('response').style.display = 'block';
                        document.getElementById('loader_id').style.display = 'none';

                    }
                });
            });




        });


        function add() {
            $("#exampleModal").modal();
            document.getElementById('loader_id').style.display = 'block';
            document.getElementById('response').style.display = 'none';
            $.ajax({
                type: 'GET',
                url: "{{URL("/dashboard/users/create")}}",
                contentType: "html",
                dataType: 'html',
                success: function (data) {

                    document.getElementById('response').innerHTML = data;
                    document.getElementById('response').style.display = 'block';
                    document.getElementById('loader_id').style.display = 'none';
                }
            });
        }

    </script>
    {{--    document.getElementById('driver_edit_modal').style.display = 'block';--}}

@endsection



