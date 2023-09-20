<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Validator};
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PasswordController extends Controller
{
    public function index(): View
    {
        # Return view with all user passwords
        return view('passwords.passwords', [
            'passwords' => Auth::user()->load('passwords')->passwords
        ]);
    }

    public function create(): View {
        # Return form view
        return view('passwords.password_create');
    }

    public function store(Request $request): RedirectResponse
    {
        # Validation rules according to exercise
        $validator = Validator::make($request->all(), [
            'site' => 'required|string|url',
            'login' => 'required|string|email',
            'password' => 'required|string',
        ]);

        # If something does not match rules, redirect to form
        # with errors by input
        if ($validator->fails()) {
            return redirect(route("passwords.create"))
                ->withErrors($validator)
                ->withInput();
        }

        # Get validated values as array
        $safe = $validator->safe()->toArray();

        # Add authenticated user id
        data_set($safe, 'user_id', Auth::id());

        # Store in passwords table
        Password::create($safe);

        # Redirect to landing
        return redirect(route("passwords"));
    }

    public function edit(Password $password): View {
        # Return form view
        return view('passwords.password_edit', ['password' => $password]);
    }

    public function update(Password $password, Request $request): RedirectResponse
    {
        # Validation rules according to exercise
        $validator = Validator::make($request->all(), [
            'site' => 'required|string|url',
            'login' => 'required|string|email',
            'password' => 'required|string',
        ]);

        # If something does not match rules, redirect to form
        # with errors by input
        if ($validator->fails()) {
            return redirect(route("passwords.edit"))
                ->withErrors($validator)
                ->withInput();
        }

        # Get validated values as array
        $safe = $validator->safe()->toArray();

        # Store in passwords table
        $password->update($safe);

        # Redirect to landing
        return redirect(route("passwords"));
    }
}
