<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('backend.index');
    }
}
