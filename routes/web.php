<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(
    [
         'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {

        Route::get('change/{data}', function ($data) {
            //  \Illuminate\Support\Facades\App::setLocate($data);
            //LaravelLocalization::setLocale($data);
            return redirect()->back();
        });
        Route::get('/forget', 'Auth\LoginController@forgetform')->name('forgetform');
        Route::post('/forget/password', 'Auth\LoginController@reserpasswors')->name('resetpassword');
        Route::get('/update/password', 'Auth\LoginController@updatepassword')->name('updatepassword');
        Route::post('/update', 'Auth\LoginController@update')->name('update');
        Route::get('logout', 'Auth\LoginController@logout')->name('custom-logout');
        Auth::routes();
        Route::get('/home', 'HomeController@index')->name('home');

        Route::group(['namespace' => 'Website'], function () {
            //    Route::get('login', "LoginController@login");
            //    Route::get('signUp', "LoginController@get_signUp_form");
            //    Route::post('signUp', "LoginController@signUp");

            Route::get('/', "HomeController@index");
            Route::get('about_us', "HomeController@about_us");
            Route::get('page/{id}', "PageController@index");
            Route::get('nationalSocieties/{id}', 'OrganizationController@index');
            Route::get('news', "NewsController@index");
            Route::get('details/{id}', "NewsController@details");
            Route::get('preview/{address}', "NewsController@preview")->name('preview');
            Route::get('opportunities', "OpportunityController@index");
            Route::get('opportunities_details/{id}', "OpportunityController@details");
            Route::get('contact_us', 'HomeController@contact_us');
            Route::post('sendMessage', 'HomeController@sendMessage');

        });

        Route::group(['namespace' => 'Dashboard'], function () {

            Route::group([
                'prefix' => 'dashboard',
                'middleware' => ['auth:web'],
            ], function () {

                Route::get('home', "HomeController@index")->name('dashboard.home');
                Route::resource('news', "NewsController");

                Route::middleware('can:siteAdmin')->group(function () {
                    /*Site Management Dashboard*/
                    Route::resource('pages', "PageController");
                    Route::resource('animatedSlides', "AnimatedSlidesController");
                    Route::resource('counters', "CounterController");
                    Route::resource('contact_us', "ContactUsController");
                    Route::resource('footer', "FooterController");
                    Route::resource('logos', "LogoController");
                    Route::resource('language', "LanguageController");

                    Route::get('user_registration', "UserController@user_registrationView")->name('user.registrationView');
                    Route::post('user_registration', "UserController@user_registration")->name('user.registration');

                });

                /* Administration Panel */
                Route::resource('volunteers', 'VolunteerController');
                Route::get('showVolunteers/{id}', 'VolunteerController@showVolunteers')->name('showVolunteers');

                Route::resource('organizations', 'OrganizationController');
                Route::resource('volunteerSupervisors', 'VolunteerSupervisorController');
                Route::resource('opportunityOfficers', 'VolunteerOpportunityOfficerController');
                Route::resource('volunteerFields', 'VolunteerFieldController');

                Route::resource('opportunities', 'OpportunityController');
                Route::get('showOpportunities/{id}', 'OpportunityController@showOpportunities')->name('showOpportunities');

                Route::resource('users', 'UserController');

                Route::resource('reports', 'ReportController');
                Route::resource('roles', 'RoleController');

                Route::resource('admins', 'AdminController');
                Route::patch('changePassword/{id}', 'AdminController@changePassword')->name('admins.updatePassword');
                Route::resource('permissions', 'PermissionController');
                Route::get('Volunteer_Supervisor/index', 'AdminController@volunteerSupervisor')->name('admin_Volunteer_Supervisor');
                Route::get('Volunteer_Supervisor/add', 'AdminController@add')->name('admin_add_Volunteer_Supervisor');
                Route::post('Volunteer_Supervisor/create', 'AdminController@create')->name('admin_create_Volunteer_Supervisor');
                Route::get('Volunteer_Supervisor/{id}', 'AdminController@edit')->name('admin_edit_Volunteer_Supervisor');
                Route::get('del-Volunteer_Supervisor/{id}', 'AdminController@delete')->name('admin_delete_Volunteer_Supervisor');
                Route::post('update-Volunteer_Supervisor/{id}', 'AdminController@updatevolunteersup')->name('admin_update_Volunteer_Supervisor');
                Route::post('Vcdata', 'AdminController@getVcdata')->name('get.Vcdata');

                // Opportunity officer
                Route::get('Volunteer_Opportunity_Officers/index', 'AdminController@Opportunity_Officers')->name('admin_Volunteer_Opportunity_Officers');
                Route::get('Volunteer_Opportunity_Officers/add', 'AdminController@add_Volunteer_Opportunity_Officers')->name('admin_add_Volunteer_Opportunity_Officers');
                Route::post('Volunteer_Opportunity_Officers/create', 'AdminController@create_Volunteer_Opportunity_Officers')->name('admin_create_Volunteer_Opportunity_Officers');
                Route::get('Volunteer_Opportunity_Officers/{id}', 'AdminController@edit_Volunteer_Opportunity_Officers')->name('admin_edit_Volunteer_Opportunity_Officers');
                Route::get('del-Volunteer_Opportunity_Officers/{id}', 'AdminController@delete_Volunteer_Opportunity_Officers')->name('admin_delete_Volunteer_Opportunity_Officers');
                Route::post('update-Volunteer_Opportunity_Officers/{id}', 'AdminController@update_Volunteer_Opportunity_Officers')->name('admin_update_Volunteer_Opportunity_Officers');
                Route::post('Voodata', 'AdminController@getVoodata')->name('get.Voodata');
                Route::post('Mvodata', 'AdminController@getMvodata')->name('get.Mvodata');
                // Route::get('Volunteer_Opportunity_Officers/add', 'AdminController@add_Volunteer_Opportunity_Officers')->name('add_Volunteer_Opportunity_Officers');
                // volunteerFields
                Route::get('VolunteerFields/index', 'AdminController@volunteer_field')->name('admin_volunteer_field');
                Route::get('VolunteerFields/add', 'AdminController@add_volunteer_field')->name('admin_add_volunteer_field');
                Route::post('VolunteerFields/create', 'AdminController@create_volunteer_field')->name('admin_create_volunteer_field');
                Route::get('VolunteerFields/{id}', 'AdminController@edit_volunteer_field')->name('admin_edit_volunteer_field');
                Route::get('del-VolunteerFields/{id}', 'AdminController@delete_volunteer_field')->name('admin_delete_volunteer_field');
                Route::post('update-VolunteerFields/{id}', 'AdminController@update_volunteer_field')->name('admin_update_volunteer_field');
                Route::post('Aovpdata', 'AdminController@getAovpdata')->name('get.Aovpdata');
                // Volunteer Opportunity
                Route::get('Managing_Volunteer_Opportunity/index', 'AdminController@manage_Volunteer_Opportunity')->name('admin_manage_Volunteer_Opportunity');
                Route::get('Managing_Volunteer_Opportunity/add', 'AdminController@add_manage_Volunteer_Opportunity')->name('admin_add_manage_Volunteer_Opportunity');
                Route::post('Managing_Volunteer_Opportunity/create', 'AdminController@create_Volunteer_Opportunity')->name('admin_create_Volunteer_Opportunity');
                Route::get('Managing_Volunteer_Opportunity/{id}', 'AdminController@edit_Volunteer_Opportunity')->name('admin_edit_Volunteer_Opportunity');
                Route::get('del-Managing_Volunteer_Opportunity/{id}', 'AdminController@delete_Volunteer_Opportunity')->name('admin_delete_Volunteer_Opportunity');
                Route::post('update-Managing_Volunteer_Opportunity/{id}', 'AdminController@update_Volunteer_Opportunity')->name('admin_update_Volunteer_Opportunity');
                Route::post('Voodata', 'AdminController@getVoodata')->name('get.Voodata');
                // Oranization Routes
                Route::get('Organization/index', 'AdminController@organization')->name('admin_organization');
                Route::get('Organization/add', 'AdminController@add_organization')->name('admin_add_organization');
                Route::post('Organization/create', 'AdminController@create_organization')->name('admin_create_organization');
                Route::get('Organization/{id}', 'AdminController@edit_organization')->name('admin_edit_organization');
                Route::get('del-Organization/{id}', 'AdminController@delete_organization')->name('admin_delete_organization');
                Route::post('update-Organization/{id}', 'AdminController@update_organization')->name('admin_update_organization');
                Route::post('Organdata', 'AdminController@getOrgandata')->name('get.Organdata');
                // News Routes
                Route::get('News/index', 'AdminController@news')->name('admin_news');
                Route::get('News/add', 'AdminController@add_news')->name('admin_add_news');
                Route::post('News/create', 'AdminController@create_news')->name('admin_create_news');
                Route::get('News/{id}', 'AdminController@edit_news')->name('admin_edit_news');
                Route::get('del-News/{id}', 'AdminController@delete_news')->name('admin_delete_news');
                Route::post('update-News/{id}', 'AdminController@update_news')->name('admin_update_news');
                Route::post('Newsdata', 'AdminController@getNewsdata')->name('get.Newsdata');
                // Volunteer Routes
                Route::get('Volunteer/index', 'AdminController@volunteer')->name('admin_volunteer');
                Route::get('Volunteer/{id}', 'AdminController@edit_volunteer')->name('admin_edit_volunteer');
                Route::get('del-Volunteer/{id}', 'AdminController@delete_volunteer')->name('admin_delete_volunteer');
                Route::post('update-Volunteer/{id}', 'AdminController@update_volunteer')->name('admin_update_volunteer');
                Route::post('Volnpdata', 'AdminController@getVolnpdata')->name('get.Volnpdata');
                // Reports Route
                Route::get('Reports/index', 'AdminController@reports')->name('admin_reports');
                Route::get('Volunteer/{id}', 'AdminController@edit_volunteer')->name('admin_edit_volunteer');
                Route::get('del-Volunteer/{id}', 'AdminController@delete_volunteer')->name('admin_delete_volunteer');
                Route::post('update-Volunteer/{id}', 'AdminController@update_volunteer')->name('admin_update_volunteer');
                Route::get('show/volunteers/{id}', 'AdminController@showVoulenteers')->name('admin_show_volunteer');

                // Accounts Routes
                Route::get('Accounts/index', 'AdminController@account')->name('admin_account');
                Route::post('update-Accounts/{id}', 'AdminController@update_account')->name('admin_update_account');

                // volunteer supervisor
                Route::post('volunteer/supervisor', 'AdminController@getSupervisor')->name('get.vc');
                                Route::post('delete/supervisorvolunteer', 'AdminController@deletesupervisorvolunteer')->name('deletesupervisorvolunteer');
                Route::post('delete/voo', 'AdminController@deletevoo')->name('deletevoo');
                Route::post('delete/volunterfield', 'AdminController@deletevolunterfield')->name('deletevolunterfield');
                Route::post('delete/deleteorganization', 'AdminController@deleteorganization')->name('deleteorganization'); 
                Route::post('delete/vo', 'AdminController@deletevo')->name('deletevo'); 
                Route::post('delete/volunteeer', 'AdminController@deletevolunteeer')->name('deletevolunteeer'); 
                Route::post('delete/news', 'AdminController@deletenews')->name('deletenews');
                Route::get('deactivate/volunteer/supervisor', 'AdminController@deactivatevolunteersupervisor')->name('deactivatevolunteersupervisor');
                Route::get('activate/volunteer/supervisor', 'AdminController@activatevolunteersupervisor')->name('activatevolunteersupervisor');
                Route::get('call/us', 'AdminController@callus')->name('admin_callus');
              
                 
                
                
            });
        });

    });

    
                                // Pages Routes
Route::get('Site-Admin/Page/index', 'SiteAdminController@page')->name('page');
Route::get('Site-Admin/Page/add', 'SiteAdminController@add_page')->name('add_page');
Route::post('Site-Admin/Page/create', 'SiteAdminController@create_page')->name('create_page');
Route::get('Site-Admin/Page/{id}', 'SiteAdminController@edit_page')->name('edit_page');
Route::get('Site-Admin/del-Page/{id}', 'SiteAdminController@delete_page')->name('delete_page');
Route::post('Site-Admin/update-Page/{id}', 'SiteAdminController@update_page')->name('update_page');
Route::post('Site-Admin/Mvodata', 'SiteAdminController@get_page_data')->name('get_page_data');
                                // news Roues
Route::get('Site-Admin/News/index', 'SiteAdminController@news')->name('site_news');
Route::get('Site-Admin/News/add', 'SiteAdminController@add_news')->name('site_add_news');
Route::post('Site-Admin/News/create', 'SiteAdminController@create_news')->name('site_create_news');
Route::get('Site-Admin/News/{id}', 'SiteAdminController@edit_news')->name('site_edit_news');
Route::get('Site-Admin/del-News/{id}', 'SiteAdminController@delete_news')->name('site_delete_news');
Route::post('Site-Admin/update-News/{id}', 'SiteAdminController@update_news')->name('site_update_news');
Route::post('Site-Admin/News/Mvodata', 'SiteAdminController@get_news_data')->name('get_news_data');
Route::post('Site-Admin/publish/news', 'SiteAdminController@publishNews')->name('site_publish_news');

                                // Animated_Slid
Route::get('Site-Admin/Animated-Slide/index', 'SiteAdminController@animated_slide')->name('animated_slide');
Route::get('Site-Admin/Animated-Slide/add', 'SiteAdminController@add_animated_slide')->name('add_animated_slide');
Route::post('Site-Admin/Animated-Slide/create', 'SiteAdminController@create_animated_slide')->name('create_animated_slide');
Route::get('Site-Admin/Animated-Slide/{id}', 'SiteAdminController@edit_animated_slide')->name('edit_animated_slide');
Route::get('Site-Admin/del-Animated-Slide/{id}', 'SiteAdminController@delete_animated_slide')->name('delete_animated_slide');
Route::post('Site-Admin/update-Animated-Slide/{id}', 'SiteAdminController@update_animated_slide')->name('update_animated_slide');
Route::post('Site-Admin/Animated-Slide/Mvodata', 'SiteAdminController@get_animated_slide')->name('get_animated_slide');
                                    // Contact_us
Route::get('Site-Admin/Contact-Us/index', 'SiteAdminController@contact_us')->name('contact_us');
Route::post('Site-Admin/Contact-Us/create', 'SiteAdminController@create_call_us')->name('create_call_us');
                                        // footer
Route::get('Site-Admin/Footer/index', 'SiteAdminController@footer')->name('footer');
Route::post('Site-Admin/Footer/create', 'SiteAdminController@create_footer')->name('create_footer');
                                    // logo
Route::get('Site-Admin/Logo/index', 'SiteAdminController@logo')->name('logo');
Route::post('Site-Admin/Logo/create', 'SiteAdminController@create_logo')->name('create_logo');
                                    // Accouunt
Route::get('Site-Admin/Accounts/index', 'SiteAdminController@sit_account')->name('sit_account');
Route::post('Site-Admin/update-Accounts/{id}', 'SiteAdminController@site_update_account')->name('site_update_account');
                                        // User-Registration
Route::get('Site-Admin/User-Registration/index', 'SiteAdminController@user_registration')->name('user_registration');
Route::post('Site-Admin/create-user', 'SiteAdminController@create_user_registration')->name('create_user_registration');
// counter
Route::get('Site-Admin/Counter/index', 'SiteAdminController@counter')->name('counter');
Route::post('Site-Admin/Counter/create', 'SiteAdminController@create_counter')->name('create_counter');
Route::post('delete/slide', 'SiteAdminController@deleteslide')->name('deleteslide');
Route::post('delete/page', 'SiteAdminController@deletepages')->name('deletepages');
Route::post('delete/siteadmin/news', 'SiteAdminController@deletenews')->name('deletesiteadminnews');




Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');  
    $exitCode = Artisan::call('config:cache');
    return 'Application cache cleared';
});


Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});