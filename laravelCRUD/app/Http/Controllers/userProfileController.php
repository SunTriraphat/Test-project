<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use League\CommonMark\Reference\Reference;

class userProfileController extends Controller
{
    //
    public function index()
    {
        $data['userProfile'] = User::orderBy('id', 'desc')->paginate(5);
        // $data['userProfile'] = tb_user::find($userId);
        return view('userProfile.index', $data);
    }

    public function create()
    {
        return view('userProfile.create');
    }


    public function store(Request $request)
    {
        // return $request->all();
       

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
    
        ]);
        

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->pasword),
            'is_admin' => '0',
        ]);

        

        // User::create([
        //     'detail' => $request->detail,
        //     'reference' => $request->reference,
        // ]);

        return response()->json([
            'success' => 'Create Success',
            'URL' => route('userProfile.index'),
        ], 201);



        // $userProfile = new tb_user;
        // $userProfile->detail = $request->detail;
        // $userProfile->reference = $request->reference;
        // $userProfile->save();

        // return redirect()->route('userProfile.index');
    }

    public function edit(User $userProfile, Request $request)
    {

        return view('userProfile.edit', compact('userProfile'));
    }

    public function update($id, $name, $email)
    {

        $userProfile = User::find($id);
        $userProfile->name = $name;
        // $userProfile->email = $email;
        $userProfile->save();
        return response()->json([
            'success' => 'edit Success',

        ], 201);
        // return redirect()->with('success', 'Edit success');
    }

    public function destroy($id)

    {
        $userProfile = User::find($id);
        $userProfile->delete();
        return response()->json([
            'success' => 'delete Success',

        ], 201);

        // return redirect()->route('userProfile.index')
        //     ->withSuccess(__('Post delete successfully.'));
    }
}
