<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserAuthenticationController extends Controller
{

    public function index()
    {

        return view('auth.login_page');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            // 'email'=>['required','email','exists:users,email'],
            'password' => ['required', 'min:5', 'max:15'],
        ],[
            'email.exists'=>'The entered email is not registered in the database'
        ]);


        if (Auth::attempt($credentials)) {
            if (!Auth::user()->is_approved ) {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                session()->flash('sweetAlertIcon', 'warning');
                return redirect()->route('index')->with('error', 'You are not yet approved by admin');
                
            } else if (Auth::user()->usertype === 'admin') {
                return redirect()->intended(route('admin.usermanagement.index'));
            } else {
                return redirect()->intended(route('users.userDashboard'));
            }
        } else {
            session()->flash('sweetAlertIcon', 'warning');
            return redirect()->route('index')->with('error', 'Wrong credentials');
        }
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {

        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:5', 'max:15'],
            'cpassword' => ['required', 'min:5', 'max:15', 'same:password'],
        ], [
            'cpassword.same' => 'Confirm password field must the password field',
        ]);

        $user = new User();
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $registered = $user->save();

        return redirect()->route('showRegistrationForm')->with($registered ? 'success' : 'error', $registered ? 'You have successfully registered' : 'Failed to register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
