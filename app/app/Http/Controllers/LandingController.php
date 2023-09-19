<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LandingController extends Controller
{
    public function show(): View
    {
        # Return welcome / landing view
        return view('welcome');
    }
}
