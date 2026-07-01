<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceholderActionController extends Controller
{
    public function __invoke(Request $request)
    {
        return back()->with('success', 'This action is wired as a UI shell placeholder.');
    }
}
