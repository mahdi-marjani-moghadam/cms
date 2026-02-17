<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as httpRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        login as traitLogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'mobile';
    }


    public function showLoginForm(Request $request)
    {

        switch (Request::segment(1)) {
            case 'admin':
                return view('admin.auth.login');
                break;
            case 'company':
                return view('auth.company.login');
                break;
            default:
                return view('auth.customer.login');
                break;
        }
    }

    public function login(httpRequest $request)
    {

        $credentials = $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ],[
            'captcha.captcha' => 'کد امنیتی نادرست است',
            'captcha.required' => 'وارد کردن کد امنیتی الزامی است',
        ]);

        // فقط mobile و password برای auth
        $loginData = [
            'mobile' => $credentials['mobile'],
            'password' => $credentials['password'],
        ];

        // اگر لاگین موفق بود
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // اگر کاربر وجود ندارد → ثبت‌نام خودکار (در صورت نیاز)
        $user = User::where('mobile', $credentials['mobile'])->first();

        if (!$user && $request->header('referer') != url('admin/login')) {

            $user = User::create([
                'mobile' => $credentials['mobile'],
                'password' => Hash::make($credentials['password']),
            ]);

            Customer::create([
                'user_id' => $user->id,
                'mobile' => $user->mobile,
            ]);

            $user->assignRole('customer');

            Auth::login($user);
            return $this->sendLoginResponse($request);
        }

        // لاگین ناموفق
        return $this->sendFailedLoginResponse($request);

        // $d = $request->validate([
        //     $this->username() => 'required|string',
        //     'password' => 'required|string',
        //     'captcha' => 'required|captcha'
        // ]);

        // $user = User::where('mobile','=',$d['mobile'])->first();
        // if($user instanceof User){
        //     return $this->traitLogin($request);
        // }

        // if (!$this->attemptLogin($request) && $request->header('referer') != url('admin/login')) {

        //         $user = User::create([
        //             'mobile' => $d['mobile'],
        //             'pass' => $d['password'],
        //             'password' => Hash::make($d['password']),
        //         ]);

        //         Customer::create([
        //             'user_id'=> $user->id,
        //             'mobile' => $user->mobile,
        //             // 'parent_id' => $request->parent_id
        //         ]);

        //         $user->assignRole('customer');


        // }

        // return $this->traitLogin($request);
    }

    protected function redirectTo()
    {

        // User role
        $roles = Auth::user()->getRoleNames();

        // Check user role
        if ($roles->contains('super admin'))
            return '/admin';
        else if ($roles->contains('company'))
            return '/company';
        else if ($roles->contains('customer'))
            return '/customer';
        else
            return '/';
    }
}
