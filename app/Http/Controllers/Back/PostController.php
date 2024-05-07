<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
Use App\Http\Requests\PostRequest;
Use App\Http\Requests\UpdatePostRequest;
use App\Models\Posts;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.post.index' ,
        ['posts' => Posts::with('User')->latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();

        $file = $request->file('image');
        $fileName = uniqid().'.'.$file->getClientOriginalextension();
        $file->storeAs('public/back/', $fileName);

        $data['user_id'] = 1;
        $data['image'] = $fileName; 
        $data['slug'] = Str::slug($data['title']);

        $data['title'] = preg_replace('/&nbsp;/', ' ', $data['title']);
        $data['desc'] = preg_replace('/&nbsp;/', ' ', $data['desc']);
        Posts::create($data);
        

        return redirect(url('post'))->with('success', 'Post has been created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('back.post.show' ,
        ['posts' => Posts::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('back.post.edit',
        ['posts' => Posts::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid().'.'.$file->getClientOriginalextension();
            $file->storeAs('public/back/', $fileName);
            
            Storage::delete('public/back/'.$request->oldImg);
            
            $data['image'] = $fileName;
        } else {
            $data['image'] = $request->oldImg;
        }
        
        $data['slug'] = Str::slug($data['title']);
        $data['title'] = preg_replace('/&nbsp;/', ' ', $data['title']);
        $data['desc'] = preg_replace('/&nbsp;/', ' ', $data['desc']);

        Posts::find($id)->update($data);
        

        return redirect(url('post'))->with('success', 'Post has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Posts::find($id);

        Storage::delete('public/back/'.$data->image);
        $data->delete();

        return response()->json([
            'message' => 'Post has been deleted !'
        ]);

    }
}
