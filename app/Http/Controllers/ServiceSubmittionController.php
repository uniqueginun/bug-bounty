<?php

namespace App\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use App\Models\Service;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductActionRequest;

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

    public function action(ProductActionRequest $request, Submission $submission)
    {

        DB::beginTransaction();

        try
        {
            $submission->makeAction($request->action, $request->notes);

            DB::commit();

            $message = 'Submittion ' . str($request->action)->title()->toString() . ' successfully.';

            return back()->with('success', $message);
        }

        catch (Throwable $th)
        {
            report($th);

            DB::rollBack();

            return back()->with('error', 'Something went wrong.');
        }
    }

    public function submittions(Service $service)
    {

        $submittions = $service->submittions()->with(['attachments', 'user'])->paginate();

        return Inertia::render('Admin/ServicesReports', [
            'submittions' => $submittions,
            'service' => $service,
            'makeAction' => false
        ]);
    }
}
