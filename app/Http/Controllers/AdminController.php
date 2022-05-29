<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {

        $usersCount = User::count();
        $postCount = Post::count();
        $categoriesCount = Category::count();
        $commentsCount = Comment::count();

        return view('admin.index', compact('usersCount', 'postCount', 'categoriesCount', 'commentsCount'));

    }
}
