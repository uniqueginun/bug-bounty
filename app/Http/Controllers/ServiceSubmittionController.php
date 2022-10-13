<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceSubmittionController extends Controller
{
    public function show(Service $service)
    {
        return Inertia::render('ProductSubmittion', [
            'service' => $service
        ]);
    }

    public function submitReport(Service $service, Request $request)
    {
        $request->validate([
            'details' => 'string|required|max:2000',
            'attachment' => 'required|file|mimes:zip'
        ]);

        $service->submitReport($request->details, $request->attachment);

        return to_route('submittion.product.details', $service->uuid)->with('success', 'Report submitted.');
    }
}
