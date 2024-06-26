<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleHandlerContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        # check is user already exists
        $ifUserExists = User::where('email', $request->email)->first();
        if (!$ifUserExists) {
            $response = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->email),
                'google_sso_flg' => 1
            ]);
            if ($response) {
                $user = User::latest()->first();
                Auth::login($user);
                return response()->json(array(
                    'status' => 200,
                    'message' => 'Account created!',
                    'account' => $ifUserExists
                ));
            }
            return response()->json(array(
                'status' => 400,
                'message' => 'Failed to create account!'
            ));
        } 
        Auth::login($ifUserExists);
        return response()->json(array(
            'status' => 200,
            'message' => 'Account created!',
            'account' => $ifUserExists
        ));
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
