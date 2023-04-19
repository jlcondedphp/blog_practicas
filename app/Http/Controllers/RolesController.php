<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{   
    public function home()
    {
        return view('roles/home', [
            'roles' => Post::orderBy('created_at', 'desc')->get()->take(6)
        ]);
    }

   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $user = $request->user();

        if ($user->isAdmin()) {
            $roles = Post::orderBy('created_at', 'desc')->get();
        } elseif ($user->isStaff()) {
            $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        } else {
            abort_unless(Auth::check(), 404);
        }
        return view('roles', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $request->user()->authorizeRoles(['is_staff', 'is_admin']);
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $request->validated();
        $user = Auth::user();

        $request->user()->authorizeRoles(['is_staff', 'is_admin']);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->is_draft = $request->input('is_draft');
        $post->user()->associate($user);

        $res = $post->save();

        if ($res) {
            return back()->with('status', 'Post has been created sucessfully');
        }

        return back()->withErrors(['msg', 'There was an error saving the post, please try again later']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        abort_unless(Auth::check(), 404);
        $request->user()->authorizeRoles(['is_staff', 'is_admin']);
        $post = Post::find($id);
        if (($post->user->id != $request->user()->id) && !$request->user()->isAdmin()) {
            abort_unless(false, 401);
        }
        return view('posts/edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $request->validated();
        $request->user()->authorizeRoles(['is_staff', 'is_admin']);
        $post = Post::find($id);
        if (($post->user->id != $request->user()->id) && !$request->user()->isAdmin()) {
            abort_unless(false, 401);
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->is_draft = $request->input('is_draft');

        $res = $post->save();

        if ($res) {
            return back()->with('status', 'Post has been updated sucessfully');
        }

        return back()->withErrors(['msg', 'There was an error updating the post, please try again later']);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        abort_unless(Auth::check(), 404);
        $request->user()->authorizeRoles(['is_staff', 'is_admin']);
        $post = Post::where('id', $id)->first();
        if (($post->user->id != $request->user()->id) && !$request->user()->isAdmin()) {
            abort_unless(false, 401);
        }

        $post->delete();

        return back()->with('status', 'Post has been deleted sucessfully');
    }
}
