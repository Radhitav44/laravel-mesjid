<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\User;
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
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('dashboard.users.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['password'] = bcrypt('secret12345');
        if (User::create($request->all())) {
            return redirect(route('users.index'))->with('success', 'Data Saved');
        }
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
        if (optional(auth()->user()->division)->name != 'Admin') {
            if (auth()->id() == $user->id) {
                $divisions = Division::all();
                return view('dashboard.users.edit', compact('user', 'divisions'));
            } else {
                return back();
            }
        }
        $divisions = Division::all();
        return view('dashboard.users.edit', compact('user', 'divisions'));
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
        if ($request->password) {
            $request['password'] = bcrypt($request->password);
        }
        if ($user->update($request->all())) {
            return redirect(route('users.index'))->with('success', 'Data Saved');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('danger', 'Data Saved');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('dashboard.users.profile', compact('user'));
    }
}
