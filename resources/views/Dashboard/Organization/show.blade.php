
@if(!empty($organization))
    <table class="table m-0 show_table" style="color: black;">
        <tr>
            <TH>{{__('dashboard/organizations.data_table_title_0')}}</TH> <td>{{$organization->name_ar}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/organizations.data_table_title_1')}}</TH> <td>{{$organization->name_en}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/organizations.data_table_title_2')}} </TH><td>{{$organization->name}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/organizations.data_table_title_3')}} </TH><td>{{$organization->email}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/organizations.data_table_title_4')}}</TH> <td>{{$organization->contact_number}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/organizations.data_table_title_7')}}  </TH><td>@if(!empty($organization->logo)) <img src="{{ asset('public/images/organizations/'.$organization->logo) }}" style=" width: 100px; height: 100px;"> @else Not Found @endif</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/organizations.data_table_title_8')}}  </TH><td>@if(!empty($organization->banner)) <img src="{{ asset('public/images/organizations/banner/'.$organization->banner) }}" style=" width: 300px; height: 150px;"> @else Not Found @endif</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/organizations.data_table_title_11')}}</TH> <td>{{$organization->site_url}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/organizations.data_table_title_12')}}</TH> <td>{{$organization->details}}</td>
        </tr>
    </table>
@else
    <h1>NOT FOUND </h1>
@endif
