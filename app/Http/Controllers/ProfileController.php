<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request, $name)
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request, $name)
    {
        $validated = $request->validateWithBag([
            'name' => ['bail', 'required', 'string', 'max:15', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', function ($attribute, $value, $fail) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $fail($attribute . ' is invalid.');
                }
            }],
            'confirmPass' => [function ($attribute, $value, $fail){
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $fail($attribute . ' is invalid.');
                }
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Incorrect password');
                }
            }],
        ]);
        return redirect('front.profile.home');
    }

}
