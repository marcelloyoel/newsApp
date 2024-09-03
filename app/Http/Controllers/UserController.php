<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin', [
            'title' => 'List User',
            'users' => User::where('status', '>', 0)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addUser',[
            'title' => 'Add New User',
            'javascript'    => 'createUser.js'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => ['unique:users', 'required'],
            'password' => ['required'],
            'email' => ['unique:users', 'required'],
            'name' => ['required'],
        ];
        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['status'] = $request->input('status');
        $validatedData['role'] = $request->input('role');

        // User::create($validatedData);
        $user = new User($validatedData);
        $user->save();
        return redirect('/users')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('editUser',[
            'title' => 'Edit User',
            'javascript'    => 'createUser.js',
            'user'  => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd('hello');
        $validatedData = $request->validate([
            'username' => ['required', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'name'     => ['required', 'string', 'max:255'],
            'role'     => ['required', 'integer'],
            'status'   => ['required', 'integer'],
        ]);
        $user->update($validatedData);
        return redirect('/users')->with('update', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->update(['status' => 0]);
        return redirect('/users')->with('delete', 'Data berhasil dihapus!');
    }
}
