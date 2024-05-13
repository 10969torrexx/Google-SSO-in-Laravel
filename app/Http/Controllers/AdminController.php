<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Departments;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        //
        return view('admin.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function departments()
    {
        $isValidUser = (Auth::user()->toArray()['role'] == 1) ? true : false;
        if($isValidUser == true) {
            $departments = Departments::get();
            return view('departments.read', compact('departments'));
        }
       return redirect('/home');
    }

     /**
     * Show the form for creating a new resource.
     */
    public function getDepartments(Request $request)
    {
        $isValidUser = (Auth::user()->toArray()['role'] == 1) ? true : false;
        if($isValidUser == true) {
            $departments = Departments::where('id', $request->id)->get();
            return response()->json(array(
                'status' => 200,
                'data' => $departments
            ));
        }
       return redirect('/home');
    }

     /**
     * Show the form for creating a new resource.
     */
    public function addDepartments(Request $request)
    {
        $isValidUser = (Auth::user()->toArray()['role'] == 1) ? true : false;
        if($isValidUser == true) {
           $departments = Departments::create([
            'department_name' => $request->department_name
           ]);
           if ($departments) {
            return redirect(route('departments'));
           }
        }
       return redirect('/home');
    }

     /**
     * Show the form for creating a new resource.
     */
    public function editDepartments(Request $request)
    {
        $isValidUser = (Auth::user()->toArray()['role'] == 1) ? true : false;
        if($isValidUser == true) {
            $departments = Departments::where('id', $request->id)->update([
                'department_name' => $request->department_name,
            ]);
           if ($departments) {
            return redirect(route('departments'));
           }
        }
       return redirect('/home');
    }

     /**
     * Show the form for creating a new resource.
     */
    public function deleteDepartments(Request $request)
    {
        $isValidUser = (Auth::user()->toArray()['role'] == 1) ? true : false;
        if($isValidUser == true) {
           $departments = Departments::where('id', $request->id)->delete();
           if ($departments) {
                return response()->json(array(
                    'status' => 200,
                    'message' => 'department deleted!'
                ));
           }
        }
       return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
