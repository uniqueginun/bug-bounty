<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/ServicesIndex', [
            'services' => Service::query()->paginate()
        ]);
    }

    public function action(Request $request, Service $service)
    {
        $request->validate([
            'action' => [
                'required', 'in:published, rejected'
            ],

            'notes' => [
                'nullable', Rule::requiredIf($request->action === 'rejected')
            ]
        ]);

        DB::beginTransaction();

        try 
        {
            $service->makeAction($request->action, $request->notes);

            DB::commit();

            return to_route('analyst.services.index')->with('success', 'Product ' . str($request->action)->title()->toString() . ' successfully.');
        } 
        
        catch (Throwable $th) 
        {
            report($th);

            DB::rollBack();

            return back()->with('error', 'Something went wrong.');
        }
    }
}
