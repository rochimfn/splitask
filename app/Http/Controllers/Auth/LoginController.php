<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;
    public function redirecTo($request)
    {
        if(Auth::user()->position == 'administrator')
        {
            return route('users');
        } elseif (Auth::user()->position == 'chief')
        {
            return route('users');
        } elseif (Auth::user()->position == 'manager')
        {
            return route('users');
        } elseif (Auth::user()->position == 'staff')
        {
            return route('users');
        } else
        {
            return route('login')->withError('Something wrong, contact the Administrator');
        }
    }

    public function username()
    {
        return 'user_name';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
