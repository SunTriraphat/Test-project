<?php

namespace App\Http\Controllers;

use App\Models\tb_addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use League\CommonMark\Reference\Reference;

class addressController extends Controller
{
    //
    public function index()
    {

        $admin = Auth::user()->is_admin;
        $email = Auth::user()->email;
        if ($admin == 1) {
            $data['addresses'] = tb_addresses::orderBy('id', 'desc')->paginate(5);
            $is_admin['admin'] = $admin;
        } else {
            $data['addresses'] = tb_addresses::where('reference', 'like', '%' . $email . '%')->paginate(5);
            $is_admin['admin'] = $admin;
        }

        return view('addresses.index', $data,$is_admin);
    }

    public function create()
    {
        $admin = Auth::user()->is_admin;
        $email = Auth::user()->email;
        if ($admin == 1) {
            $data['user'] = User::orderBy('id', 'desc')->paginate(5);
        } else {
            $data['user'] = User::where('email', 'like', '%' . $email . '%')->paginate(5);
        }

        return view('addresses.create', $data);
    }


    public function store(Request $request)
    {
        // return $request->all();



        $request->validate([
            'detail' => 'required',
            'reference' => 'required',
        ]);

        $address = tb_addresses::where('reference', 'like', '%' . $request->reference . '%')->get();;
        if ($address->isEmpty()) {
            tb_addresses::create([
                'detail' => $request->detail,
                'reference' => $request->reference,
            ]);

            

            return response()->json([
                'success' => 'Create Success',
                'URL' => route('jobs.index'),
                'message' => 'Create Success'
            ], 201);

        } else {
            return response()->json([
                'success' => 'Create not Success',
                'URL' => route('jobs.index'),
                'message' => 'user have address already'
            ], 201);
        }

        

       



        // $addresses = new tb_addresses;
        // $addresses->detail = $request->detail;
        // $addresses->reference = $request->reference;
        // $addresses->save();

        // return redirect()->route('addresses.index');
    }

    public function edit(tb_addresses $address, Request $request)
    {
        $admin = Auth::user()->is_admin;
        $email = Auth::user()->email;
        if ($admin == 1) {
            $data['user'] = User::orderBy('id', 'desc')->paginate(5);
        } else {
            $data['user'] = User::where('email', 'like', '%' . $email . '%')->paginate(5);
        }
        return view('addresses.edit', compact('address'),$data);
    }

    public function update($id, $detail, $reference)
    {

        $addresses = tb_addresses::find($id);
        $addresses->detail = $detail;
        $addresses->reference = $reference;
        $addresses->save();
        return response()->json([
            'success' => 'edit Success',

        ], 201);
        // return redirect()->with('success', 'Edit success');
    }

    public function destroy($id)

    {
        $addresses = tb_addresses::find($id);


        $addresses->delete();
        return response()->json([
            'success' => 'delete Success',

        ], 201);

        // return redirect()->route('addresses.index')
        //     ->withSuccess(__('Post delete successfully.'));
    }
}
