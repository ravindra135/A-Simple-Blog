<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentSluggable\Sluggable;
use Flasher\Prime\Flasher;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\New_;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name','id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request, FlasherInterface $flasher)
    {
//        return $request->all();

        $user = Auth::user();
        $input = $request->all();

        if($file = $request->file('photo_id')) {

            $name = time() . '_post-' . $file->getClientOriginalName();

            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }
//        else {
//
//            // For Testing Only;
//            $default = Photo::where(['file'=>'def_post.png'])->first();
//            $input['photo_id'] = $default->id;
//        }

        $user->posts()->create($input);

        Session::flash('post_created', 'Post has been Created');

        if(Session::has('post_created')) {
            $flasher->addSuccess('Post Has Been Created;');
        } else {
            $flasher->addError('Oops!! Something Bad Happened;');
        }

        return redirect(route('posts.index'));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $post = Post::findOrFail($id);
        $input = $request->all();

        if($file = $request->file('photo_id')) {

            $name = time() . '_post-' . $file->getClientOriginalName();

            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }
//        else {
//
//            // For Testing Only;
//            $default = Photo::where(['file'=>'def_post.png'])->first();
//            $input['photo_id'] = $default->id;
//        }

        $post->update($input);

        Session::flash('post_updated', 'Post has been Updated');

        if(Session::has('post_updated')) {
            $flasher->addInfo('Post Has Been Updated;');
        } else {
            $flasher->addError('Oops!! Something Bad Happened;');
        }

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, FlasherInterface $flasher)
    {
        $post = Post::findOrFail($id);

        if($post->photo_id == null){

            $post->delete();

        } else {

        unlink(public_path(). $post->photo->file);
        $post->photo->delete() && $post->delete();

        }

        Session::flash('post_deleted', 'Post has Been Deleted');

        if(Session::has('post_deleted')) {
            $flasher->addWarning('Post Has Been Deleted;');
        } else {
            $flasher->addError('Oops!! Something Bad Happened;');
        }

        return redirect(route('posts.index'));
    }

    public function post($id) {

        $post = Post::findBySlugOrFail($id);
        $comments = $post->comments()->whereIsActive(1)->get();
        $categories = Category::all();

        // This will increment 'views' in Database;
//        $post->postViews();

        // This is For Accurate Views Count; Using Session
        $postKey = 'post_' . $post->id;

        if(!Session::has($postKey)) {
            $post->postViews();
            Session::put($postKey, 1);
        }

        return view('post', compact('post', 'comments', 'categories'));
    }

    public function getSlug() {

        $slug = SlugService::createSlug(Post::class, 'slug', \request('title'));
        return response()->json(['slug'=>$slug]);
    }

}
