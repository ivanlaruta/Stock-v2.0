<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class SesionController extends Controller
{
    public function index(Request $request)
    {   
        if (Auth::user()->rol== '1')
        {
            return redirect()->route('principal.index');
        }
    }   
}
