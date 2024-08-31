<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

App::setLocale(env('SITE_LANG'));

forceRedirect();

// bank
Route::post('/returnBank', [CompanyController::class, 'returnBank'])
    ->name('company.products.returnBank')
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);;

Route::get('/runcronjob', function () {
    echo Artisan::call('schedule:run');
    echo Artisan::call('schedule:list');
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
});

include_once 'companyRoute.php';
include_once 'customerRoute.php';
include_once 'adminRoute.php';

Auth::routes();

include_once 'frontRoute.php';


// function get_web_page($url)
// {
//     $options = array(
//         CURLOPT_RETURNTRANSFER => true,     // return web page
//         CURLOPT_HEADER         => false,    // don't return headers
//         CURLOPT_FOLLOWLOCATION => true,     // follow redirects
//         CURLOPT_ENCODING       => "",       // handle all encodings
//         CURLOPT_USERAGENT      => "spider", // who am i
//         CURLOPT_AUTOREFERER    => true,     // set referer on redirect
//         CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
//         CURLOPT_TIMEOUT        => 120,      // timeout on response
//         CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
//         CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
//     );

//     $ch      = curl_init($url);
//     curl_setopt_array($ch, $options);
//     $content = curl_exec($ch);
//     $err     = curl_errno($ch);
//     $errmsg  = curl_error($ch);
//     $header  = curl_getinfo($ch);
//     curl_close($ch);

//     $header['errno']   = $err;
//     $header['errmsg']  = $errmsg;
//     $header['content'] = $content;
//     return $header;
// }

// function file_get_contents_curl($url)
// {

//     $ch = curl_init();

//     curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
//     curl_setopt($ch, CURLOPT_HEADER, 0);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

//     $data = curl_exec($ch);
//     print_r($data);
//     die();
//     curl_close($ch);

//     return $data;
// }
//$a=get_web_page('https://emalls.ir/%D9%84%DB%8C%D8%B3%D8%AA-%D9%82%DB%8C%D9%85%D8%AA_%D8%AF%D8%B1%D8%A8-%D8%B6%D8%AF-%D8%B3%D8%B1%D9%82%D8%AA-~Category~25236');
//echo '<pre/>';
//print_r($a);
//DB::listen(function ($query) {
//    echo '<pre style="background-color:yellow;' .
//        'font-size:x-small;">' .
//        'Query fired ' .
//        '"' . $query->sql . '" ' .
//        '<small>(' . __FILE__ . ' - ' . __LINE__ . ')</small>' .
//        '</pre>';
//
//});
