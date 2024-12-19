<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ProfileController extends Controller
{

    function password(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator->getMessageBag());
        }
        $oldpassword = $request->oldpassword;
        $user = $request->user();
        if (password_verify($oldpassword, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('home/profile')->with(['message' => 'User password changed.']);
        }
        return redirect('home/profile')->with(['message' => 'User password not edited because old password is not correct.']);
    }

    function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
        ]);
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator->getMessageBag());
        }
        $user = $request->user();
        try {
            if($request->email != $user->email) {
                $user->email_verified_at = null;
            }
            $user->update($request->except('role'));// Excluimos el campo role para que los usuarios normales no se lo puedan editar
            return redirect('home/profile')->with(['message' => 'User edited.']);
        } catch(\Exception $e) {
            return redirect('home/profile')->with(['message' => 'User not edited.']);
        }
    }

    
}