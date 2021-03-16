<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        User::create($request->all());
    }

     
    public function show($id)
    {
        return User::findOrFail($id);
    }

   
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
