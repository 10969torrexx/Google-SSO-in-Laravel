<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Departments;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 1) {
           return redirect(route('departments'));
        } else {
            $user = User::join('departments', 'users.department', '=', 'departments.id')
            ->select('users.*', 'departments.*')
            ->where('users.id', Auth::user()->id)
            ->get();
            return view('home', compact('user'));
        }
    }
}
