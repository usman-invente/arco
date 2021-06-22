@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pagebody">
            <br><br>
            <div class="row" style="margin-top:30px;">
                <div class="col-md-12">
                    <a  href="{{route('admin_add_volunteer_field')}}"  class="pull-right"> <button type="button"
                            class="btn btn-success mr-1 mb-1">
                            <i class="fa fa-plus"></i>
                            {{__('dashboard/lang.Add Volunteer Fields') }}
                        </button></a>
                    <a href="#" id="delete_record" class="pull-right"> <button type="button"
                            class="btn btn-danger mr-1 mb-1">
                            <i class="fa fa-trash-o"></i>
                            {{ __('dashboard/lang.Delete') }}
                        </button></a>
                 

                </div>


            </div>
            <br>
            <div class="br-section-wrapper">
                <div class="table-wrapper">
                    <table id="vc" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                 <th><input type="checkbox" class='checkall' id='checkall'></th>
                                 <th> {{__('dashboard/lang.Name') }}</th>
                                 <th> {{__('dashboard/lang.domain') }}</th>
                                 <th> {{__('dashboard/lang.url') }}</th>
                                 <th> {{__('dashboard/lang.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->

    @endsection
    @section('script')
        <script>
            $(document).ready(function() {
                $('#vc').DataTable({
                     "language": {
    "emptyTable": "ليست هناك بيانات متاحة في الجدول",
    "loadingRecords": "جارٍ التحميل...",
    "processing": "جارٍ التحميل...",
    "lengthMenu": "أظهر _MENU_ مدخلات",
    "zeroRecords": "لم يعثر على أية سجلات",
    "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
    "infoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
    "infoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
    "search": "ابحث:",
    "paginate": {
        "first": "الأول",
        "previous": "السابق",
        "next": "التالي",
        "last": "الأخير"
    },
    "aria": {
        "sortAscending": ": تفعيل لترتيب العمود تصاعدياً",
        "sortDescending": ": تفعيل لترتيب العمود تنازلياً"
    },
    "select": {
        "rows": {
            "_": "%d قيمة محددة",
            "0": "",
            "1": "1 قيمة محددة"
        },
        "1": "%d سطر محدد",
        "_": "%d أسطر محددة",
        "cells": {
            "1": "1 خلية محددة",
            "_": "%d خلايا محددة"
        },
        "columns": {
            "1": "1 عمود محدد",
            "_": "%d أعمدة محددة"
        }
    },
    "buttons": {
        "print": "طباعة",
        "copyKeys": "زر <i>ctrl<\/i> أو <i>⌘<\/i> + <i>C<\/i> من الجدول<br>ليتم نسخها إلى الحافظة<br><br>للإلغاء اضغط على الرسالة أو اضغط على زر الخروج.",
        "copySuccess": {
            "_": "%d قيمة نسخت",
            "1": "1 قيمة نسخت"
        },
        "pageLength": {
            "-1": "اظهار الكل",
            "_": "إظهار %d أسطر"
        },
        "collection": "مجموعة",
        "copy": "نسخ",
        "copyTitle": "نسخ إلى الحافظة",
        "csv": "CSV",
        "excel": "Excel",
        "pdf": "PDF",
        "colvis": "إظهار الأعمدة",
        "colvisRestore": "إستعادة العرض"
    },
    "autoFill": {
        "cancel": "إلغاء",
        "info": "مثال عن الملئ التلقائي",
        "fill": "املأ جميع الحقول بـ <i>%d&lt;\\\/i&gt;<\/i>",
        "fillHorizontal": "تعبئة الحقول أفقيًا",
        "fillVertical": "تعبئة الحقول عموديا"
    },
    "searchBuilder": {
        "add": "اضافة شرط",
        "clearAll": "ازالة الكل",
        "condition": "الشرط",
        "data": "المعلومة",
        "logicAnd": "و",
        "logicOr": "أو",
        "title": [
            "منشئ البحث"
        ],
        "value": "القيمة",
        "conditions": {
            "date": {
                "after": "بعد",
                "before": "قبل",
                "between": "بين",
                "empty": "فارغ",
                "equals": "تساوي",
                "not": "ليس",
                "notBetween": "ليست بين",
                "notEmpty": "ليست فارغة"
            },
            "number": {
                "between": "بين",
                "empty": "فارغة",
                "equals": "تساوي",
                "gt": "أكبر من",
                "gte": "أكبر وتساوي",
                "lt": "أقل من",
                "lte": "أقل وتساوي",
                "not": "ليست",
                "notBetween": "ليست بين",
                "notEmpty": "ليست فارغة"
            },
            "string": {
                "contains": "يحتوي",
                "empty": "فاغ",
                "endsWith": "ينتهي ب",
                "equals": "يساوي",
                "not": "ليست",
                "notEmpty": "ليست فارغة",
                "startsWith": " تبدأ بـ "
            }
        },
        "button": {
            "0": "فلاتر البحث",
            "_": "فلاتر البحث (%d)"
        },
        "deleteTitle": "حذف فلاتر"
    },
    "searchPanes": {
        "clearMessage": "ازالة الكل",
        "collapse": {
            "0": "بحث",
            "_": "بحث (%d)"
        },
        "count": "عدد",
        "countFiltered": "عدد المفلتر",
        "loadMessage": "جارِ التحميل ...",
        "title": "الفلاتر النشطة"
    },
    "searchPlaceholder": "ابحث ..."
} ,
                    order: [
                        [1, "asc"]
                    ],
                    lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 صفوف', '25 صفًا', '50 صفًا', 'الجميع' ]
                ],
                    dom: 'Blfrtip',
               buttons: [
                    'excel', 'csv', 'pdf', 'copy'
                ],
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax": {
                        "url": "{{ route('get.Aovpdata') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data": {
                            _token: "{{ csrf_token() }}"
                        }
                    },
                    "columns": [  {
                        "data": "checkbox",
                        "orderable": false,
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "domain"
                    },
                    {
                        "data": "url"
                    },
                    {
                        "data": "action"
                    }
                    ],

                });
            });

            // Check all 
            $('#checkall').click(function() {
                if ($(this).is(':checked')) {
                    $('.delete_check').prop('checked', true);
                } else {
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
            function checkcheckbox() {

                // Total checkboxes
                var length = $('.delete_check').length;

                // Total checked checkboxes
                var totalchecked = 0;
                $('.delete_check').each(function() {
                    if ($(this).is(':checked')) {
                        totalchecked += 1;
                    }
                });

                // Checked unchecked checkbox
                if (totalchecked == length) {
                    $("#checkall").prop('checked', true);
                } else {
                    $('#checkall').prop('checked', false);
                }
            }

        </script>
@endsection
