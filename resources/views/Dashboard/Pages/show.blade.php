
@if(!empty($page))
    <table class="table m-0 show_table" style="color: black;">

        <tr>
            <TH>{{__('dashboard/pages.data_table_title_1')}}</TH> <td>{{$page->title_en}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/pages.data_table_title_0')}}</TH> <td>{{$page->title_ar}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/pages.data_table_title_2')}} </TH><td>{{$page->status}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/pages.data_table_title_3')}} </TH><td>{{$page->name}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/pages.data_table_title_4')}}</TH> <td>{{$page->updated_at}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/pages.data_table_title_6')}} </TH><td>{{$page->created_at}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/pages.data_table_title_8')}} </TH><td>{{$page->heading}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/pages.data_table_title_7')}}  </TH><td>{{$page->content}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/pages.data_table_title_9')}}  </TH><td>@if(!empty($page->page_image)) <img src="{{ asset('public/images/pages/'.$page->page_image) }}" style=" width: 300px; height: 200px;"> @else Not Found @endif</td>
        </tr>
    </table>
@else
    <h1>NOT FOUND </h1>
@endif
