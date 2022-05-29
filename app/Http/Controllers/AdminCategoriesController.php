<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
//        return $request->all();

        $input = $request->all();

        $name = $input['name'];
        $slug = Str::of(Str::lower($name))->slug('-');
        Category::create([
            'name' => $name,
            'slug' => $slug
        ]);

        \session()->flash('cat_added');
        if(Session::has('cat_added')) {
            $flasher->addSuccess('Category Added');
        } else {
            $flasher->addError('Oops!! Something bad Happened');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);
        $categories = Category::all();

        return view('admin.categories.edit', compact('category', 'categories'));
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
        //
        $category = Category::findOrFail($id);
        $input = $request->all();
        $name = $input['name'];
        $slug = Str::of(Str::lower($name))->slug('-');
        $category->update([
            'name' => $name,
            'slug' => $slug
        ]);

        \session()->flash('cat_updated');
        if(Session::has('cat_updated')) {
            $flasher->addinfo('Category has been Updated');
        } else {
            $flasher->addError('Oops!! Something bad Happened');
        }


        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, FlasherInterface $flasher)
    {
        Category::findOrFail($id)->delete();

        $flasher->addWarning('Category has been Removed');

        return back();
    }
}
