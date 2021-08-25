<?php

namespace App\Http\Controllers;

use App\Models\Friend;

class HomeController extends Controller
{
    public function index()
    {
        $friends    = Friend::orderByDesc('sort')->orderByDesc('come')->get();
        $categories = Friend::CATEGORY;

        return view('friend.index', compact('friends', 'categories'));
    }

    public function openSafeMode()
    {
        open_safe_mode();
    }

    public function clearSafeMode()
    {
        clear_safe_mode();
    }

    public function info()
    {
        phpinfo();
    }
}
