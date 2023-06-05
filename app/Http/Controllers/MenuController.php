<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Log;    //Log::info();

class MenuController extends Controller
{
    /**
     * メニュー
     */
    public function menu()
    {
        return view('menu/menu');
    }
}