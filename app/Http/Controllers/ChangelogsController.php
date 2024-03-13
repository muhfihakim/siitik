<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangelogsController extends Controller
{
    public function index()
    {
        return view('changelogs');
    }
}
