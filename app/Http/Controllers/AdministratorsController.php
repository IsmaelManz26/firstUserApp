<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Models\User;

class AdministratorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AdminMiddleware::class);
        $this->middleware(SuperAdminMiddleware::class)->only(['indexSuper']);
    }

    public function index()
    {
        $users = User::where('role', '<>', 'admin')->orderBy('name')->get();
        return view('admin.index', compact('users'));
    }

    public function indexSuper()
    {
        $users = User::orderBy('name')->get();
        return view('admin.indexSuper', compact('users'));
    }
}