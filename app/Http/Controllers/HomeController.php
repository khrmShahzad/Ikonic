<?php

namespace App\Http\Controllers;

use App\View\Components\Connections;
use App\View\Components\Received;
use App\View\Components\Sent;
use App\View\Components\Suggestion;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $suggestions = New Suggestion();
        $sent = New Sent();
        $received = New Received();
        $connections = New Connections();
        return view('home', ['suggestions' => $suggestions, 'sent' => $sent, 'received' => $received, 'connections' => $connections]);
    }
}
