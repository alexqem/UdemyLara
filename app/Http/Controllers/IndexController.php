<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index() {

        return Inertia::render('Index', [
            'message' => 'Example'
        ]);
    }
    public function show() {
        return Inertia::render('Show');
    }
}
