<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Flasher\Prime\Flasher;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home(FlasherInterface $flasher) {

        if(Auth::check()) {

          $flasher->addSuccess('Hello!! Welcome To Laravel Tutorial');

        } else {

            $flasher->addWarning('Login & Enjoy tons of Features;');

        }

        return view('home');

    }

    public function index()
    {
        $posts = Post::paginate(5);
        $categories = Category::all();
        return view('blog-home', compact('posts', 'categories'));
    }
}
