
@if(!empty($opportunities))
    <table class="table m-0 show_table" style="color: black;">

        <thead>
        <tr>
            <th>{{__('dashboard/volunteers.data_table_title_18')}}</th>
            <th>{{__('dashboard/volunteers.data_table_title_19')}}</th>
            <th>{{__('dashboard/volunteers.data_table_title_3')}}</th>
            <th>{{__('dashboard/volunteers.data_table_title_14')}}</th>
            <th>{{__('dashboard/volunteers.data_table_title_4')}}</th>
        </tr>
        </thead>
        <tbody >
            @if(!empty($opportunities))
                @foreach($opportunities as $opportunity)
                    <tr>
                        <td>{{ $opportunity->title }}</td>
                        <td>{{ $opportunity->name }}</td>
                        <td>{{ $opportunity->name_en }}</td>
                        <td>{{ $opportunity->city }}</td>
                        <td>{{ $opportunity->status }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>

    </table>
@else
    <h1>NOT FOUND </h1>
@endif
