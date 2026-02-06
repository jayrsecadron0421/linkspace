<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function edit(Request $request)
    {
        return view('settings', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = $request->user();
        $user->update($request->only('name','email'));

        return back()->with('success','Updated');
    }
}
