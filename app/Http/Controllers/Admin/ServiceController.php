<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Inertia\Inertia;
use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductActionRequest;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/ServicesIndex', [
            'services' => Service::query()->withCount('approvedSubmittions')->paginate()
        ]);
    }

    public function action(ProductActionRequest $request, Service $service)
    {

        DB::beginTransaction();

        try
        {
            $service->makeAction($request->action, $request->notes);

            DB::commit();

            $message = 'Product ' . str($request->action)->title()->toString() . ' successfully.';

            return to_route('analyst.services.index')->with('success', $message);
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
            'service' => $service
        ]);
    }
}
