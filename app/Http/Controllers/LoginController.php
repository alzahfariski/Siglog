<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Contracts\Service\Attribute\Required;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            // $request->session()->regenerate();

            return redirect('/administrator/dashboard');
        }

        return redirect()->route('login')->with('failed', 'Login gagal!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
    public function forgotpw()
    {
        return view('login.forgotpw');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        $action_link = route('reset.password.form', ['token' => $token, 'email' => $request->email]);
        $body = "Hay, " . $request->email . " lupa password ?";
        Mail::send('email-forgot', ["action_link" => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('alzahfariski@gmail.com', 'sistem informasi geografis logistik polresta bengkulu');
            $message->to($request->email, 'Alzah Fariski')
                ->subject('Reset Password');
        });

        return redirect()->route('forgotpw')->with('success', 'silahkan cek email');
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('login.reset')->with(['token' => $token, 'email' => $request->email]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();
        if (!$check_token) {
            return back()->withInput()->with('fail', 'invalid token');
        } else {
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password)
            ]);
            DB::table('password_resets')->where([
                'email' => $request->email
            ])->delete();
            return redirect()->route('login')->with('info', 'your password has been change')->with('verifiedEmail', $request->email);
        }
    }
}
