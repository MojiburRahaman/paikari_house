<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\SummerNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function DashboardView()
    {
        return view('backend.main');
    }
    public function Adminlogin()
    {
        return view('backend.login');
    }
    public function AdminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('Adminlogin');
    }
    public function AdminloginPost(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {

            return response()->json(['success' => 'Login Sucessfully Redirecting...'], 200);
        }
        return response()->json(['error' => 'Authincation Failed'], 403);
    }
    public function SummerNoteUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $image_extension = Str::random(5) . '.' . $image->getClientOriginalExtension();
            $url = public_path('summernote/' . $image_extension);
            Image::make($image)->save($url, 100);

            $ckeditor = new SummerNote;
            $ckeditor->ckeditor_img = $image_extension;
            $ckeditor->save();
            $image_url = asset('projects/ckeditor/' . $image_extension);
            return response()->json([$image_url]);
        }
    }
}
