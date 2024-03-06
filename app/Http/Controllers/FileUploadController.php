<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');

        $path = Storage::disk('s3')->putFile('/', $file);

        return response()->json(['path' => $path]);
    }
}
