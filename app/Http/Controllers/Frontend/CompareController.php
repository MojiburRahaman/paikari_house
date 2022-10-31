<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CompareController extends Controller
{
    public function CompareView()
    {

        $compares =  Compare::Where('cookie_id', Cookie::get('cookie_id'))->with('Product.Brand')->get();
        return view('frontend.pages.compare', [
            'compares' => $compares,
        ]);
    }
    public function CompareViewPost(Request $request)
    {
        $request->validate([
            'id' => ['required'],
        ]);

        if ($request->hasCookie('cookie_id')) {
            // if user has cookie
            $cookie_id_generate = $request->cookie('cookie_id');
        } else {
            $cookie_id_generate = time() . Str::random(10);
            Cookie::queue('cookie_id', $cookie_id_generate, 129600);
        }


        $product_already_add = Compare::Where('cookie_id', Cookie::get('cookie_id'))
            ->Where('product_id', $request->id);
        if ($product_already_add->exists()) {

            $compare =  Compare::Where('cookie_id', Cookie::get('cookie_id'))->count();

            $html = '<a href="' . route("CompareView") . '" class="d-flex align-items-center text-reset">
            <i class="la la-refresh la-2x opacity-80"></i>
            <span class="flex-grow-1 ml-1">
                            <span class="badge badge-primary badge-inline badge-pill">' . $compare . '</span>
                        <span class="nav-box-text d-none d-xl-block opacity-70">Compare</span>
            </span>
        </a>';

            return response()->json($html);
        }

        $Compare = new Compare;
        $Compare->cookie_id = $cookie_id_generate;
        $Compare->product_id = $request->id;
        $Compare->save();

        $compare =  Compare::Where('cookie_id', Cookie::get('cookie_id'))->count();

        $html = '<a href="' . route("CompareView") . '" class="d-flex align-items-center text-reset">
        <i class="la la-refresh la-2x opacity-80"></i>
        <span class="flex-grow-1 ml-1">
                        <span class="badge badge-primary badge-inline badge-pill">' . $compare . '</span>
                    <span class="nav-box-text d-none d-xl-block opacity-70">Compare</span>
        </span>
    </a>';

        return response()->json($html);
    }
    public function CompareReset()
    {
        Compare::Where('cookie_id', Cookie::get('cookie_id'))->delete();
        return redirect()->route('CompareView');
    }
}
