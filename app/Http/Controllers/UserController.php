<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $data = User::all();
        return view('user.user', compact('data'));
    }
    public function create(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->userpassword = $request->password;
        if (isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $profile =  $request->image->move(public_path('photo'), $imageName);
            $user->photo = $imageName;
            $user->save();
        }
        $user->save();

        return redirect()->route('user');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user')->with('success', 'User deleted successfully');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->userpassword = $request->password;

        if (isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $profile =  $request->image->move(public_path('photo'), $imageName);
            $user->photo = $imageName;
            $user->save();
        }

        $user->save();

        return redirect()->route('user')->with('success', 'User updated successfully');
    }

}
