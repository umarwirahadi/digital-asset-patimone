<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['title'=>'User','subtitle'=>'List of users','data'=>User::latest()->get()];
        return view('database.user.index',compact('data'));
    }
    public function create()
    {
        $data = ['title'=>'User','subtitle'=>'New User'];
        return view('database.user.create',compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_url'=>'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        if($request->hasFile('profile_url')){
            $image          = $request->file('profile_url');
            $unique_name    = uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/statics/img/'),$unique_name);
        }        

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'profile_path' => $unique_name,
            'is_active' => '1',
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('user.index')
                         ->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $validatedData['name'] ?? $user->name,
            'email' => $validatedData['email'] ?? $user->email,
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $user->password,
        ]);

        return redirect()->route('user.show', $user->id)
                         ->with('success', 'User updated successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')
                         ->with('success', 'User deleted successfully.');
    }
}
