<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Home', [
            'services' => Service::query()->published()->get(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
