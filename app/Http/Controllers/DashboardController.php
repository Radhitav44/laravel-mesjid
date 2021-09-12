<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', true)->paginate(8);
        return view('dashboard.index', compact('posts'));
    }
}
