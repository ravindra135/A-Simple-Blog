<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = Photo::all();

        return view('admin.media.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.upload');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');

        $name = time() . '-' . $file->getClientOriginalName();
        $file->move('images', $name);

        Photo::create(['file'=>$name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::findOrFail($id);

        return $photo->post('photo_id')->id;
//        return view('admin.media.show');
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
        $photo = Photo::findOrFail($id);
        return view('admin.media.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $photo = Photo::findOrFail($id);
        $inputs = $request->all();

        $photo->update($inputs);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        unlink(public_path(). $photo->file);

        $photo->delete();

        return redirect(route('media.index'));
    }

    public function massDelete(Request $request) {

        if(isset($request->delete_single)) {

            $this->destroy($request->photo);
            return redirect(route('media.index'));

        }


        $photos = Photo::findOrFail ($request->checkBoxArray);

        foreach ($photos as $photo) {
            unlink(public_path(). $photo->file);
            $photo->delete();
        }

        return back();

    }
}
