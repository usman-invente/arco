
@if(!empty($opportunity))
    <table class="table m-0 show_table" style="color: black;">

        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_18')}}  </TH><td>{{ $opportunity->title }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_29')}}</TH> <td>{{ $opportunity->description }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_14')}} </TH><td>{{ $opportunity->city }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_3')}} </TH><td>{{$opportunity->name_en}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_20')}} </TH><td>{{ $opportunity->start_date }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_21')}}  </TH><td>{{ $opportunity->end_date }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_22')}}  </TH><td>{{  $opportunity->opportunity_type }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_19')}}  </TH><td>{{ $opportunity->name }}</td>
        </tr>


        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_22')}}  </TH><td>{{ $opportunity->field_en}}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_25')}}  </TH><td>{{ $opportunity->support_for_volunteer }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_26')}}  </TH><td>{{ $opportunity->benefit_for_volunteer }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_27')}}  </TH><td>{{ $opportunity->issues }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_30')}}  </TH><td>{{ $opportunity->no_of_volunteers }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_31')}}  </TH><td>{{ $opportunity->no_of_hours }}</td>
        </tr>
        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_28')}}  </TH><td>{{ $opportunity->age_type }}</td>
        </tr>

        <tr>
            <TH>{{__('dashboard/volunteers.data_table_title_4')}}  </TH><td>{{ $opportunity->status }}</td>
        </tr>


    </table>
@else
    <h1>NOT FOUND </h1>
@endif
