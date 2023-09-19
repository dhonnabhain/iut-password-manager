<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{File, Storage, Validator};
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PasswordController extends Controller
{
    public function index(): View {
        # Take all files in storage/passwords
        # Iterate and for each file, read content and update it to fit view requirements
        $passwords = collect(
            File::allFiles(storage_path('app/passwords'))
        )
            ->map(function(\SplFileInfo $file) {
                $content = json_decode(Storage::get('passwords/' . $file->getFilename()), true);

                # Add an initial entry in $content with the first letter of url domain
                data_set($content, 'initial', substr(explode('//', $content['url'])[1], 0, 1));

                return $content;
            });

        # Return password list view with all passwords content
        return view('show_passwords', ['passwords' => $passwords]);
    }

    public function create(): View {
        # Return form view
        return view('password_create');
    }

    public function store(Request $request): RedirectResponse
    {
        # Validation rules according to exercise
        $validator = Validator::make($request->all(), [
            'url' => 'required|string|url',
            'email' => 'required|string|email',
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

        # Encrypt password in $safe array
        data_set($safe, 'password', bcrypt($safe['password']));

        # Store validated in a json file under storage/app/passwords
        # To ensure one file per validated request, use datetime checksum
        # Tell PHP to not escape content + make it clean
        Storage::put(
            'passwords/' . md5(now()->toDateTimeString()) . '.json',
            json_encode($safe, JSON_UNESCAPED_SLASHES, JSON_PRETTY_PRINT)
        );

        # Redirect to landing
        return redirect(route("landing"));
    }
}
