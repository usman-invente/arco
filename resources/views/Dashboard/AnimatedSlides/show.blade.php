
@if(!empty($slide))
    <table class="table m-0 show_table" style="color: black;">

        <tr>
            <TH>{{__('dashboard/animatedSlides.data_table_title_1')}}</TH> <td>{{$slide->name}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/animatedSlides.data_table_title_2')}} </TH><td>@if(!empty($slide->image)) <img src="{{ asset('public/images/animatedSlides/'.$slide->image) }}" style=" width: 300px; height: 200px;"> @else Not Found @endif</td>

        </tr>
        <tr>
            <TH>{{__('dashboard/animatedSlides.data_table_title_3')}} </TH><td>{{$slide->status}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/animatedSlides.data_table_title_4')}}</TH> <td>{{$slide->sequence}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/animatedSlides.data_table_title_5')}} </TH><td>{{$slide->created_at}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/animatedSlides.data_table_title_6')}}  </TH><td>{{$slide->updated_at}}</td>
        </tr>

    </table>
@else
    <h1>NOT FOUND </h1>
@endif
