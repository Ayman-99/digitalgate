<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Base
{

    public function __construct()
    {
    }

    public function index(Request $request, $name)
    {
        return view('profile');
    }

    public function update(Request $request, $name)
    {
        $validated = $request->validate([
            'name' => ['bail', 'required', 'string', 'min:3', 'max:15'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', $request->input('email') !== Auth::user()->email ? 'unique:users' : '', function ($attribute, $value, $fail) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $fail($attribute . ' is invalid.');
                }
            }],
            'confPass' => [function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->getAuthPassword())) {
                    session()->flash('updateDataFlag', "1");
                    $fail('Incorrect password');
                }
            }],
        ]);
        session()->flash('messageUpdateData', "Data has been updated");
        $user = User::find(Auth::id());
        $user->name = $this->validation_input($request->input('name'));
        $user->email = $this->validation_input($request->input('email'));
        $user->save();
        return redirect()->route('front.profile.home', ['name'=>$user->name]);
    }

    public function updatePassword(Request $request, $name){
        $validated = $request->validate([
            'oldpass' => ['bail', 'required', 'string', 'min:3', 'max:15', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->getAuthPassword())) {
                    $fail('Old password is incorrect');
                    session()->flash('updatePasswordFlag', "1");
                }
            }],
            'newpass' => ['required', 'string', 'min:8', 'max:22']
        ]);
        session()->flash('messageUpdatePassword', "Password has been changed");
        $user = Auth::user();
        $user->password = Hash::make($request->input('newpass'));
        $user->save();
        return redirect()->route('front.profile.home', ['name'=> $user->name]);
    }
}
