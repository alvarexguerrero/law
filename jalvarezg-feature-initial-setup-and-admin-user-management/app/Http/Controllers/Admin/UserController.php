<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Ensure this is the base controller
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate(20); // Paginate for better display
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, # Corrected unique rule
            'role' => 'required|in:client,lawyer,admin',
            'specialization' => 'nullable|string|max:65535', // Max length for TEXT type
            'verified' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.edit', $user->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->only(['name', 'email', 'role', 'specialization']);

        // Handle 'verified' checkbox - it's only present if checked, or if we use a hidden field.
        // A simpler way for a boolean:
        $data['verified'] = $request->has('verified');


        // Prevent admin from un-admin-ing the last admin or self if it's the only one
        if ($user->isAdmin() && $data['role'] !== 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
                return redirect()->route('admin.users.edit', $user->id)
                            ->with('error', 'Cannot remove the last admin role.')
                            ->withInput();
            }
        }

        // Only lawyers should have specialization
        if ($data['role'] !== 'lawyer') {
            $data['specialization'] = null;
        }


        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // We can add destroy, create, store methods later if needed.
    // For now, focusing on edit/update of existing users.
}
