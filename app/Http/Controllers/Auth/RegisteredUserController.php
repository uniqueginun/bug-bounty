<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
            'department_name' => ['nullable', 'string', 'max:20'],
            'mobile' => ['nullable', 'numeric'],
            'account_type' => ['required', 'string', Rule::in(['provider', 'submitter'])],
            'redirect_to' => [
                'nullable', Rule::exists('services', 'uuid')
            ]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department' => $request->department_name,
            'mobile' => $request->mobile,
            'role' => $request->account_type,
            'active' => true
        ]);

        event(new Registered($user));

        Auth::login($user, $request->remember);

        if(Str::isUuid($request->redirect_to)) {
           return to_route('submittion.product.details', $request->redirect_to);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
