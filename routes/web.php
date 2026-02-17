<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SpiderController;
use App\Http\Controllers\CaptchaController;

App::setLocale(env('SITE_LANG'));

forceRedirect();

// bank
Route::post('/returnBank', [CompanyController::class, 'returnBank'])
    ->name('company.products.returnBank')
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
;

Route::get('/runcronjob', function () {
    // echo Artisan::call('schedule:work'); // local
    // echo '<br>'.Artisan::call('schedule:run');
    // echo '<br>'.Artisan::call('schedule:list');
    if (env('TEMPLATE_NAME') == 'eden') {
        return getGoldPrice('online');
    }

});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
});

Route::get('/', [CaptchaController::class, 'index']);
Route::post('/captcha-validation', [CaptchaController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [CaptchaController::class, 'reloadCaptcha']);



include_once 'companyRoute.php';
include_once 'customerRoute.php';
include_once 'adminRoute.php';

Auth::routes();

Route::get('spider', [SpiderController::class, 'spider']);
Route::get('/spider/reload', [SpiderController::class, 'reload']);
Route::post('/spider/addToCms', [SpiderController::class, 'reloadAdd']);
Route::get('spider/instagram/{id}/{count}', [SpiderController::class, 'instagram']);

include_once 'frontRoute.php';


