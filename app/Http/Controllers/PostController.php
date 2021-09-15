<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Post;
use App\Models\PostView;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = optional(auth()->user()->division)->name;
        if ($role == 'Admin' || $role == 'Ketua Pengurus') {
            $posts = Post::all();
        } else {
            $posts = Post::where('division_id', auth()->user()->division_id)->get();
        }
        return view('dashboard.posts.index', compact('posts', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (optional(auth()->user()->division)->name == 'Admin') {
            $divisions = Division::whereNotIn('id', [1, 2, 3, 4])->get();
        } else {
            $divisions = Division::where('id', auth()->user()->division_id)->get();
        }
        return view('dashboard.posts.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $this->validate($request, [
            'title' => 'required|min:5',
            'division_id' => 'required|numeric',
            'body' => 'required|min:10',
        ]);
        $post['slug'] = Str::slug($request->title);
        if ($request->has('status')) {
            $post['status'] = $request->has('status') ? true : false;
        }
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->image->move(public_path('assets/posts'), $imageName);
        }
        $documentName = null;
        if ($request->hasFile('document')) {
            $documentName = time() . '.' . $request->file('document')->extension();
            $request->document->move(public_path('assets/documents'), $documentName);
        }
        $post['image'] = $imageName;
        $post['document'] = $documentName;

        if (auth()->user()->posts()->create($post)) {
            return redirect(route('posts.index'))->with('success', 'Data Saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        if ($route == 'dashboard') {
            $this->view($post, $route);
        }
        return view('dashboard.posts.show', compact('post', 'route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $divisions = Division::all();
        return view('dashboard.posts.edit', compact('post', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $postData = $this->validate($request, [
            'title' => 'required|min:5',
            'division_id' => 'required|numeric',
            'body' => 'required|min:10',
        ]);
        $postData['slug'] = Str::slug($request->title);
        if ($request->has('status')) {
            $postData['status'] = $request->has('status') ? true : false;
        }

        if ($post->update($postData)) {
            return redirect(route('posts.index'))->with('success', 'Data Saved');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->delete()) {
            return redirect(route('posts.index'))->with('danger', 'Data Saved');
        }
    }

    public function publish(Post $post)
    {
        if ($post->update(['status' => true])) {
            return redirect(route('posts.index'))->with('success', 'Data Saved');
        }
    }

    public function download(Post $post)
    {
        return response()->download(public_path('assets/documents/' . $post->document));
    }

    public function view(Post $post, $route)
    {
        if (!PostView::where(['user_id' => auth()->id(), 'post_id' => $post->id])->first()) {
            auth()->user()->views()->create(['post_id' => $post->id]);
            return redirect(route($route));
        }
    }
}
