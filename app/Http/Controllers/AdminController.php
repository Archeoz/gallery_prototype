<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function postlogin(Request $request)
    {
        $email = User::where('email', $request->email)->first();
        if ($email->role == 'user') {
            return back()->with('erroremail', '* Youre not admin, you cant login!');
        }
        if (!Hash::check($request->password, $email->password)) {
            return back()->with('errorpassword', '* That password is wrong');
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('adminpage');
        } else {
            return back();
        }
    }

    public function uploaddata()
    {
        $auth = Auth::user()->role == "admin";

        if(!$auth){
            return redirect('/');
        }

        $upload = Gallery::join('users','users.id','galleries.id_user')
            ->orderByRaw("FIELD(galleries.status,'pending','accept','declined')")
            ->select('galleries.*','users.username')
            ->get();
        return view('admin.userupload',compact('upload'));
    }

    public function editstatusupload(Request $request,$id_gallery)
    {
        $auth = Auth::user()->role == "admin";

        if(!$auth){
            return redirect('/');
        }

        Gallery::where('id_gallery',$id_gallery)->update([
            'status' => $request->changestatus,
        ]);
        return back();
    }

    public function userdata()
    {
        $auth = Auth::user()->role == "admin";

        if(!$auth){
            return redirect('/');
        }

        $user = User::where('role','user')
            ->orderByRaw("FIELD(status,'pending','active','blocked')")->get();
        return view('admin.userdata',compact('user'));
    }

    public function editstatususer(Request $request)
    {
        dd($request->input());
        $auth = Auth::user()->role == "admin";

        if(!$auth){
            return redirect('/');
        }
        // User::where('id',$id)->update([
        //     'status' => $request->changestatus,
        // ]);
        return back();
    }
}
