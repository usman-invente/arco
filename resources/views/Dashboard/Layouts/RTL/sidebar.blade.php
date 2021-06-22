<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        @can('isAllowed')

        @can('siteAdmin')
        <li class="navigation-header">
            <span>{{__('dashboard/sidebar.site_administration')}}</span>
            <i class="zmdi zmdi-more"></i>
        </li>

        <li>
            <a href="{{ route('dashboard.home') }}"><div class="pull-left"><i class="zmdi zmdi-home mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.dashboard')}}</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="{{ route('pages.index') }}"><div class="pull-left"><i class="zmdi zmdi-pages mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.pages_Manager')}}</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="{{ route('news.index') }}"><div class="pull-left"><i class="zmdi zmdi-account-calendar mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.news')}}</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="{{ route('animatedSlides.index') }}"><div class="pull-left"><i class="zmdi zmdi-slideshow mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.animated_slides')}}</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="{{ route('counters.index') }}"><div class="pull-left"><i class="zmdi zmdi-confirmation-number mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.counter')}}</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="{{ route('contact_us.index') }}"><div class="pull-left"><i class="zmdi zmdi-phone mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.call_Us')}}</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="{{ route('footer.index') }}"><div class="pull-left"><i class="zmdi zmdi-boat mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.footer')}}</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="{{ route('logos.index') }}"><div class="pull-left"><i class="zmdi zmdi-image mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.logos')}}</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="{{ route('admins.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.account')}}</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="{{ route('user.registrationView') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.user_Registration')}}</span></div><div class="clearfix"></div></a>
        </li>
        @endcan

        @if(\Illuminate\Support\Facades\Auth::user()->role_id != \App\User::TYPE_SITE_ADMIN)
            @can('allowedUsers',collect(['isAllowed']))
                <li class="navigation-header">
                    <span>{{__('dashboard/sidebar.administration')}}</span>
                    <i class="zmdi zmdi-more"></i>
                </li>
                <li class="navigation-header">
                    <span>{{ \Illuminate\Support\Facades\Auth::user()->name }} ( {{ \App\Role::where('id',\Illuminate\Support\Facades\Auth::user()->role_id)->first()->role }} )</span>
                    <i class="zmdi zmdi-more"></i>
                </li>


                <li>
                    <a href="{{ route('dashboard.home') }}"><div class="pull-left"><i class="zmdi zmdi-home mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.dashboard')}}</span></div><div class="clearfix"></div></a>
                </li>

                @can('allowedUsers',collect(['volunteer_supervisor_access']))
                    <li>
                        <a href="{{ route('volunteerSupervisors.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.volunteer_Supervisors')}}</span></div><div class="clearfix"></div></a>
                    </li>
                @endcan
                @can('allowedUsers',collect(['volunteer_opportunity_officers_access']))
                <li>
                    <a href="{{ route('opportunityOfficers.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text ">{{__('dashboard/sidebar.volunteer_Opportunities_Officers')}}</span></div><div class="clearfix"></div></a>
                </li>
                @endcan
                @can('allowedUsers',collect(['volunteer_fields_access']))
                <li>
                    <a href="{{ route('volunteerFields.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.area_of_Volunteer_Opportunities')}}</span></div><div class="clearfix"></div></a>
                </li>
                @endcan
                @can('allowedUsers',collect(['opportunities_access']))
                <li>
                    <a href="{{ route('opportunities.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.managing_Volunteer_Opportunities')}}</span></div><div class="clearfix"></div></a>
                </li>
                @endcan
                @can('allowedUsers',collect(['organizations_access']))
                <li>
                    <a href="{{ route('organizations.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.national_Societies')}}</span></div><div class="clearfix"></div></a>
                </li>
                @endcan
                @can('allowedUsers',collect(['reports_access']))
                <li>
                    <a href="{{ route('reports.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.reports')}}</span></div><div class="clearfix"></div></a>
                </li>
                @endcan
                @can('allowedUsers',collect(['volunteers_access']))
                <li>
                    <a href="{{ route('volunteers.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.volunteers')}}</span></div><div class="clearfix"></div></a>
                </li>
                @endcan
{{--                <li>--}}
{{--                    <a href="#"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.messages')}}</span></div><div class="clearfix"></div></a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.call_Us')}}</span></div><div class="clearfix"></div></a>--}}
{{--                </li>--}}
                <li>
                    <a href="{{ route('news.index') }}"><div class="pull-left"><i class="zmdi zmdi-account-calendar mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.news')}}</span></div><div class="clearfix"></div></a>
                </li>
                @can('allowedUsers',collect(['profiles_access']))
                <li>
                    <a href="{{ route('admins.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.account')}}</span></div><div class="clearfix"></div></a>
                </li>
                @endcan
                @can('allowedUsers',collect(['roles_access']))
                <li>
                    <a href="{{ route('roles.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.user_Roles')}}</span></div><div class="clearfix"></div></a>
                </li>
                @endcan
                @can('allowedUsers',collect(['permissions_access']))
                <li>
                    <a href="{{ route('permissions.index') }}"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">{{__('dashboard/sidebar.permissions_Management')}}</span></div><div class="clearfix"></div></a>
                </li>
                @endcan
            @endcan

        @endif
        @endcan
    </ul>
</div>
