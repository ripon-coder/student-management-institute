<?php

namespace App\Providers;
use App\Models\studentModel;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use DB;
use Auth;
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
        view()->composer('layouts.app', function($view) {
            $data = array();


            // $data['studentbar']= studentModel::select('totalAmount', 'payAmount')
            // ->get()
            // ->groupBy(function($val) {
            //     return Carbon::parse($val->created_at)->format('m');
            // });


            $data['monthlyhowarkotha'] = studentModel::whereMonth('created_at', Carbon::now()->month)->sum('totalAmount');
            $data['monthlyhoice'] = studentModel::whereMonth('created_at', Carbon::now()->month)->sum('payAmount');
            $view->with('data', $data);
         });
    }
}
