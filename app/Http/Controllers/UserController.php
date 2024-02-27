<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function postlogin(Request $request)
    {
        $email = User::where('email', $request->email)->first();
        if (!$email) {
            return back()->with('erroremail', '* That email isnt registered yet');
        }
        if ($email->status == 'pending') {
            return back()->with('erroremail', '* That email is on pending state, wait for admin to activate ur account');
        }
        if ($email->status == 'blocked') {
            return back()->with('erroremail', '* That email was blocked by admin, contact admin for detail');
        }

        if (!Hash::check($request->password, $email->password)) {
            return back()->with('errorpassword', '* That password is wrong');
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('mainpage');
        } else {
            return redirect('/');
        }
    }

    public function postregister(Request $request)
    {
        $email = User::where('email', $request->email)->first();
        if ($email) {
            return back()->with('erroremail', '* This email is already registered');
        }
        if ($request->password == $request->repassword) {
            $user = User::create([
                'username' => $request->username,
                'favthing' => $request->favthing,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return redirect('/');
        } else {
            return back()->with('errorpassword', '* This repassword isnt same with password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function forgpasspost(Request $request)
    {
        $email = User::where('email', $request->email)->first();
        if (!$email) {
            return back()->with('erroremail', '* That email is not found');
        }

        $favthing = User::where('email', $email->email)
            ->where('favthing', $request->favthing)->first();
        if (!$favthing) {
            return back()->with('errorfavthing', '* Your favorite thing is incorrect');
        }

        return view('recvpass', compact('favthing'));
    }

    public function recvpasspost(Request $request, $id)
    {
        User::where('id', $id)->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect('/');
    }
}
