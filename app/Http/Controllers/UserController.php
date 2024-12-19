<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'in:admin,user'],
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->getMessageBag());
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with(['message' => 'User created.']);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $currentUser = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'string', 'in:admin,user'],
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->getMessageBag());
        }

        // Evitar que el superusuario cambie su propio rol
        if ($user->id == $currentUser->id && $request->role != 'superadmin') {
            return redirect()->route('users.index')->with(['message' => 'Superadmin cannot change their own role.']);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with(['message' => 'User updated.']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $currentUser = Auth::user();

        // Verificar si es el único superusuario
        if ($user->role == 'superadmin' && User::where('role', 'superadmin')->count() == 1) {
            return redirect()->route('users.index')->with(['message' => 'Cannot delete the only superadmin.']);
        }

        // Evitar que el superusuario se elimine a sí mismo
        if ($user->id == $currentUser->id) {
            return redirect()->route('users.index')->with(['message' => 'Superadmin cannot delete themselves.']);
        }

        $user->delete();

        return redirect()->route('users.index')->with(['message' => 'User deleted.']);
    }
}