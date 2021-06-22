
@if(!empty($new))
    <table class="table m-0 show_table" style="color: black;">

        <tr>
            <TH>{{__('dashboard/news.data_table_title_1')}}</TH> <td>{{$new->description}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/news.data_table_title_2')}} </TH><td>{{$new->address}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/news.data_table_title_3')}} </TH><td>{{$new->status}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/news.data_table_title_9')}}</TH> <td>{{$new->name}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/news.data_table_title_5')}} </TH><td>{{$new->created_at}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/news.data_table_title_7')}}  </TH><td>{{$new->content}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/news.data_table_title_8')}}  </TH><td>@if(!empty($new->image)) <img src="{{ asset('public/images/news/'.$new->image) }}" style=" width: 300px; height: 200px;"> @else Not Found @endif</td>
        </tr>
    </table>
@else
    <h1>NOT FOUND </h1>
@endif
