<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_job;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['jobs'] = tb_job::orderBy('id', 'desc')->paginate(5);
        return view('home');
        // return view('jobs.index', $data);
        
    }

    public function adminHome()
    {
        return view('adminHome');
    }

}
