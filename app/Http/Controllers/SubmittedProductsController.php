<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;

class SubmittedProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:provider');
    }

    public function index(Request $request)
    {
        $services = $request->user()->services()->with('approvedSubmittions')->simplePaginate();

        return Inertia::render('Products', compact('services'));
    }


    public function create()
    {
        return Inertia::render('ProductCreate');
    }

    public function store(ProductStoreRequest $request)
    {
        $request->user()->services()->forceCreate($request->validated());

        return to_route('products.index')->with('success', 'Product submitted.');
    }
}
