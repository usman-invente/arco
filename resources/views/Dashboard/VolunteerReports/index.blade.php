@extends('Dashboard.home')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pagebody">
            <br><br>
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="card" style="padding-bottom: 72px;padding-top: 72px;">
                        <center>
                            <h2 class="text-bold-700 mt-1 text-center">{{ $totalVolunteerOpportunities }}</h2>
                            <p class="mb-0">
                                {{ __('dashboard/lang.TOTAL VOLUNTEER OPPORTUNITIES') }}
                            </p>
                        </center>

                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="card" style="padding-bottom: 72px;padding-top: 72px;">
                        <center>
                            <h2 class="text-bold-700 mt-1 text-center">{{ $totalVolunteers }}</h2>
                            <p class="mb-0">{{ __('dashboard/lang.TOTAL VOLUNTEERS') }}</p>
                        </center>

                    </div>
                </div>
                
            </div>
            <br>
            <div class="br-section-wrapper">
                <div class="table-wrapper">
                    <table id="vc" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('dashboard/lang.Assembly') }}</th>
                                <th>{{ __('dashboard/lang.Number Of Opportunities') }}</th>
                                <th>{{ __('dashboard/lang.Number of Volunteers') }}</th>
                                <th>{{ __('dashboard/lang.Supervisor Name') }}</th>
                                <th>{{ __('dashboard/lang.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organizations as $val)
                                <tr>
                                    <td>{{ $val->name_en }} </td>
                                    <td>{{ $val->total_opportunities }}</td>
                                    <td>{{ $val->total_Volunteers }}</td>
                                    <td>{{ $val->supervisor_name }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('admin_show_volunteer', $val->id) }}"> 
                                            Volunteers
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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
                    responsive: true,
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
                });
            });

        </script>
    @endsection
