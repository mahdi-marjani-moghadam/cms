<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;



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

        $lang = app()->setLocale(env('SITE_LANG'));
        $lang = app()->getLocale();

        if($lang == 'en') View::share('ltr', true);
        else View::share('ltr', false);

        //
        Blade::directive('convertCurrency', function ($money) {
            return "<?php echo number_format($money); ?>";
        });




        view()->composer('admin/*', function () {
            $commentCount = Comment::where('status','',0)->count();
            $orderCount = Order::whereIn('status',[0, 2])->count();
            $contactCount = Contact::where('status','',0)->count();

            View::share('commentCount',$commentCount );
            View::share('orderCount',$orderCount );
            View::share('contactCount',$contactCount );
        });


    }
}
