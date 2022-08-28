<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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

    public function store(Request $request) {
      Contact::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'mobile_number' => $request->mobile_number,
        'message' => $request->message
      ]);
      
      return response()->json(['success'=>'Form is successfully submitted!']);
    }

}
