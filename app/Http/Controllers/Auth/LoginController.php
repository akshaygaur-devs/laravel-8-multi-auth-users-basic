<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:builder_usr')->except('logout');
        $this->middleware('guest:architect_usr')->except('logout');
    }
    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }
    
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            // dd("ok");
            return redirect()->intended('/admin');
        }
        // dd("not ok");
        return back()->withInput($request->only('email', 'remember'));
    }
    public function showBuilderUsrLoginForm()
    {
        return view('auth.login', ['url' => 'builder_usr']);
    }
    
    public function builderUsrLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
    
        if (Auth::guard('builder_usr')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
    
            return redirect()->intended('/builder_usr');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    public function showArchitectUsrLoginForm()
    {
        return view('auth.login', ['url' => 'architect_usr']);
    }
    
    public function architectUsrLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
    
        if (Auth::guard('architect_usr')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
    
            return redirect()->intended('/architect_usr');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}
