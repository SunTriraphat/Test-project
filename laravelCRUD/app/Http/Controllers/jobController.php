<?php

namespace App\Http\Controllers;


use App\Models\tb_job;
use App\Models\User;
use Illuminate\Http\Request;
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;

use League\CommonMark\Reference\Reference;

class jobController extends Controller
{
    //
    public function index()
    {
        $admin = Auth::user()->is_admin;
        $email = Auth::user()->email;
        $user = Auth::user();
        if($admin == 1){
            $data['jobs'] = tb_job::orderBy('id', 'desc')->paginate(5);
        }else{
            $data['jobs'] = tb_job::where('reference', 'like', '%' .$email . '%')->get();
        }
        // $data['jobs'] = tb_job::orderBy('id', 'desc')->paginate(5);
        // $data['jobs'] = tb_job::find($userId);
        return view('jobs.index', $data);
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

        return view('jobs.create',$data);
    }


    public function store(Request $request)
    {
        // return $request->all();



        $request->validate([
            'detail' => 'required',
            'reference' => 'required',
        ]);

        

        tb_job::create([
            'detail' => $request->detail,
            'reference' => $request->reference,
        ]);

        
        return response()->json([
            'success' => 'Create Success',
            'URL' => route('jobs.index'),
        ], 201);



        // $jobs = new tb_job;
        // $jobs->detail = $request->detail;
        // $jobs->reference = $request->reference;
        // $jobs->save();

        // return redirect()->route('jobs.index');
    }

    public function edit(tb_job $job, Request $request)
    {
        $admin = Auth::user()->is_admin;
        $email = Auth::user()->email;
        if ($admin == 1) {
            $data['user'] = User::orderBy('id', 'desc')->paginate(5);
        } else {
            $data['user'] = User::where('email', 'like', '%' . $email . '%')->paginate(5);
        }
        return view('jobs.edit', compact('job'),$data);
    }

    public function update($id, $detail, $reference)
    {

        $jobs = tb_job::find($id);
        $jobs->detail = $detail;
        $jobs->reference = $reference;
        $jobs->save();
        return response()->json([
            'success' => 'edit Success',

        ], 201);
        // return redirect()->with('success', 'Edit success');
    }

    public function destroy($id)

    {
        $jobs = tb_job::find($id);
        

        $jobs->delete();
        return response()->json([
            'success' => 'delete Success',

        ], 201);

        // return redirect()->route('jobs.index')
        //     ->withSuccess(__('Post delete successfully.'));
    }
}
