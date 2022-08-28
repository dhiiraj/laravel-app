<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function index()
    {
        return view('dashboard', ['name' => 'James']);
    }

}
