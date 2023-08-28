<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function loginGoogle() {
        // dd('coba');
        return Socialite::driver('google')->redirect();
        // return LaravelGmail::redirect();
    }

    public function callbackGoogle() {
        $user = Socialite::driver('google')->user();
        // LaravelGmail::makeToken();

        // dd($user);
        $this->_registerOrLoginUser($user);

        return redirect('/home')->with('success', 'Welcome ');
    }

    protected function _registerOrLoginUser($data) {
        $user = User::where('email', $data->email)->first();

        if(!$user) {
            return redirect('login')->with("error", "Maaf, anda belum terdaftar oleh sistem");
            $user = new User;
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();
        }

        Auth::login($user);
    }
}
