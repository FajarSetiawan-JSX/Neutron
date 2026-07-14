<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TentorRouteController extends Controller
{
    public function home()
    {
        return Inertia::render('Tentor/Home');
    }
}
