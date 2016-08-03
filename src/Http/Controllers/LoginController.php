<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class LoginController
 * @package Joselfonseca\LaravelAdmin\Http\Controllers
 */
class LoginController extends Controller
{

    use AuthenticatesAndRegistersUsers;


    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('LaravelAdmin::Auth.login');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->to(config('laravel-admin.routePrefix', 'backend').'/'.config('laravel-admin.afterLoginRoute'));
        }
        return redirect()->route('LaravelAdminLogin')
            ->withInput($request->only('email', 'remember'))
             ->withErrors([
                 'email' => $this->getFailedLoginMessage(),
             ]);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
