
@if(!empty($user))
    <table class="table m-0 show_table" style="color: black;">

        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_13')}}  </TH><td>@if(!empty($user->person_picture)) <img src="{{ asset('public/images/users/volunteerSupervisors/'.$user->person_picture) }}" style=" width: 300px; height: 200px;"> @else Not Found @endif</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_1')}}</TH> <td>{{$user->name}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_2')}} </TH><td>{{$user->email}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_3')}} </TH><td>{{$user->name_en}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_10')}} </TH><td>{{$user->contact_number}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_11')}}  </TH><td>{{$user->address}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_14')}}  </TH><td>{{$user->city}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_12')}}  </TH><td>@if(!empty($user->passport_picture)) <img src="{{ asset('public/images/users/volunteerSupervisors/passport/'.$user->passport_picture) }}" style=" width: 300px; height: 200px;"> @else Not Found @endif</td>
        </tr>


    </table>
@else
    <h1>NOT FOUND </h1>
@endif
