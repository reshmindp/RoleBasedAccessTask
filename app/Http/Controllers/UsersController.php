<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('app.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::where('name', '!=', 'delete post')->get();

        return view('app.users.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'permissions' => 'required|array|min:1',  
            'permissions.*' => 'exists:permissions,id', 
        ]);
    
        
        $status = $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  
        ]);
    
        
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $user->syncPermissions($permissions);
        }

        $status ? Toastr::success("New post has been added!", "Success", ["positionClass" => "toast-bottom-left"]) : Toastr::error("Some error occurred", "Error", ["positionClass" => "toast-bottom-left"]);

    
        return redirect()->route('users.index');
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
        $permissions = Permission::where('name', '!=', 'delete post')->get();
        $user = User::find($id);

        return view('app.users.edit', compact('permissions','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:users,email,' . $user->id,  
            'permissions' => 'array|min:1',  
            'permissions.*' => 'exists:permissions,id',  
        ]);

       $status = $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->has('permissions')) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $user->syncPermissions($permissionNames);
        }

        $status ? Toastr::success("User has been updated!", "Success", ["positionClass" => "toast-bottom-left"]) : Toastr::error("Some error occurred", "Error", ["positionClass" => "toast-bottom-left"]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
