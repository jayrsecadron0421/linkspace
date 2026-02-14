<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard() {
        $users = User::all();
        $posts = Post::all();

        $users = User::count();
        $posts = Post::count();

        return view('admin.dashboard', compact('users','posts'));
    }

    public function ban(Request $request, User $user)
    {
        $days = $request->days;

        $user->update([
            'is_active' => false,
            'banned_until' => Carbon::now()->addDays($days)
        ]);

        return back();
    }

    public function unban(User $user)
    {
        $user->update([
            'is_active' => true,
            'banned_until' => null
        ]);

        return back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>$request->role_id, // Changed from hardcoded 2
            'is_active'=>1
        ]);
        return back();
    }

    public function search(Request $request)
    {
        $users = User::where('name','like','%'.$request->q.'%')
            ->orWhere('email','like','%'.$request->q.'%')
            ->get();

        return view('admin.partials.users-table', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

    public function deletePost(Post $post) {
        $post->delete();
        return back();
    }

    public function users() {
        $users = User::all();
        $roles = \App\Models\Role::all(); // Add this line
        return view('admin.users', compact('users', 'roles')); // Update this line
    }


    public function settings() {
        return view('admin.settings');
    }

    public function security() {
        return view('admin.security');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        auth()->user()->update([
            'name' => $request->name
        ]);

        return back()->with('success','Profile updated');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password'=>'Wrong password']);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success','Password updated');
    }

}

