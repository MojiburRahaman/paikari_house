<?php

namespace App\Http\Controllers\dashboard\vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;


class VendorController extends Controller
{
    public function VendorDashboardView()
    {

        return view('backend.vendor.main');
    }
    public function VendorLogin()
    {

        return view('backend.vendor.login');
    }
    public function VendorRegister(Request $request)
    {
        $request->validate([
            'user_name' => ['required', 'string'],
            'name' => ['required', 'unique:vendors,shop_name'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Vendor::create([
            'name' => $request->user_name,
            'shop_name' => $request->name,
            'slug' => Str::slug($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json('Registerd Successfully');
    }
    public function VendorLoginPost(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required',],
        ]);

        // Auth::guard('vendor')->attempt(['email' => $request->email, 'password' => $request->password]);
        if (Auth::guard('vendor')->attempt($request->only('email', 'password'))) {
            # code...
            return redirect()->route('VendorDashboardView');
        }
        return back()->with('alert', 'Something Went wrong');
    }
    public function VendorLogout(Request $request)
    {
        Auth::guard('vendor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    function VendorAccessDenied(){

        if (auth('vendor')->user()->can('Vendor_Access_Redirect',auth('vendor')->user())) {
            
            return redirect()->route('VendorDashboardView');
        }
        return view('backend.vendor.access-denied');

    }
}
