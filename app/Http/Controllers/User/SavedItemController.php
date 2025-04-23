<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SavedItemController extends Controller
{
    /**
     * Display the user's saved items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.saved');
    }
}