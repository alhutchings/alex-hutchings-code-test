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

        $image = $request->filename;

        // beggining is removed from base64 string
        $image = str_replace('data:application/octet-stream;base64,', '', $image);

        // spaces are replaced with '+'
        $image = str_replace(' ', '+', $image);

        // a name is randomly assigned
        $imageName = Str::random(10) . '.STL';

        // the image is saved with it's image name for later retrieval
        $newimage = Image::create([
            'title' => $request->title,
            'filename' => $imageName
        ]);

        // it is saved in storage/files
        Storage::disk('files')->put($imageName, base64_decode($image));

        return $newimage;
    }
}
