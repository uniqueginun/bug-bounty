<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function __invoke(Request $request)
    {
        if(! Storage::exists($request->zip)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return Storage::download($request->zip);
    }
}
