<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageDefaultController extends Controller
{
    public function index()
    {
        return view('acceuil');
    }
}
