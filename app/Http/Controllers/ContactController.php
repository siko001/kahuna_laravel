<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller {
    public function getView() {
        return view('contact');
    }

    public function submitForm(Request $request) {
        $incomingFields =  $request->validate([
            "full-name" => "required",
            "email" => "required|email"
        ]);
        return view('thankyou');
    }
}
