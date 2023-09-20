<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Validator};
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TeamController extends Controller
{
    public function index(): View
    {
        # Return view with all user teams
        return view('teams.teams', [
            'teams' => Auth::user()->load('teams')->teams
        ]);
    }

    public function create(): View {
        # Return form view
        return view('teams.team_create');
    }

    public function store(Request $request): RedirectResponse
    {
        # Validation rules according to exercise
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:teams,name',
        ]);

        # If something does not match rules, redirect to form
        # with errors by input
        if ($validator->fails()) {
            return redirect(route("teams.create"))
                ->withErrors($validator)
                ->withInput();
        }

        # Get validated values as array
        $safe = $validator->safe()->toArray();

        # Store in teams table
        $team = Team::create($safe);

        # Associate user to team
        Auth::user()->teams()->syncWithoutDetaching($team->id);

        # Redirect to landing
        return redirect(route("teams"));
    }
}
