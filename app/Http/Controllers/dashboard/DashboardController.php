<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\SummerNote;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class DashboardController extends Controller
{
    public function DashboardView()
    {
        // return 1;
        return view('backend.main');
    }
    public function SummerNoteUpload(Request $request )
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
