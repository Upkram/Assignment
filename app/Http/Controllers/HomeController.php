<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Questions;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        echo "<pre>"; print_r(Questions::with('quiz')->get()); echo "</pre>"; die('end of code');

        return view('home');
    }
}
