<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admincontroller extends Controller
{
    public function admin()
    {
    return view('admin.dashboard');

    }
    public function property()
    {
        return view('livewire.properties');
}
}



///mail
// public function sendActivationEmail($user)
// {
//     \Mail::to($user->email)->send(new ActivationAccount($user))(instance of ActivationAccount);
//     return redirect()->back()->with('success', 'Activation email sent successfully.');
// }
