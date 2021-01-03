<?php

namespace App\Providers;

use App;
use App\Models\Partner;
use App\Models\PgOther;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Session;

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
        Schema::defaultStringLength(191);
         view()->composer('*',function($settings){
            $settings->with('gs', DB::table('generalsettings')->find(1));

            $settings->with('sb1', DB::table('banners')->where('slug','side-banner1')->first());
            $settings->with('sb2', DB::table('banners')->where('slug','side-banner2')->first());
            $settings->with('abt', DB::table('pg_abouts')->first());


            $settings->with('t_recipes', DB::table('recipes')->where('status',1)->orderBy('views', 'desc')->take(20)->get());

            $settings->with('t_recipes', DB::table('recipes')->where('status',1)->orderBy('views', 'desc')->take(20)->get());

            $settings->with('rc_subs', SubCategory::where('status',1)->get());
            $settings->with('partnrs',  Partner::orderBy('id','desc')->get());

            $settings->with('pgotherss', PgOther::orderBy('id','desc')->where('status',1)->get());



        });
    }
}
