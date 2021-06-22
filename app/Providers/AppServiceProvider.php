<?php

namespace App\Providers;

use App\ContactUs;
use App\Footer;
use App\Logo;
use App\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $footer=Footer::select('footer_image','description', 'facebook', 'twitter', 'instagram', 'youtube')->first();
        $logos=Logo::select( 'position', 'logo')->get();
        $contact_us=ContactUs::select('main_address', 'second_address', 'main_phone', 'second_phone', 'email', 'second_email', 'location','time')->first();

        $static_pages=Page::where(['is_menu_bar'=>0,'status_id'=>1])->orderBy('id','ASC')->get();


        View::share([
            'footer'=>$footer,
            'logos'=>$logos,
            'contact_us'=>$contact_us,
            'static_pages'=>$static_pages
        ]);
    }
}
