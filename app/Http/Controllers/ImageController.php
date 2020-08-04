<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use App\Models\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {

        $image = $request->image;
        $image = str_replace('data:model/stl;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10) . '.stl';

        $newimage = Image::create([
            'title' => $request->title,
            'filename' => $imageName
        ]);

        Storage::disk('files')->put($imageName, base64_decode($image));

        return $newimage;
    }
}
