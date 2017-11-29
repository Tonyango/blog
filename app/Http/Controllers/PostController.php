<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Create variable and store all blog posts in it from db.
        $posts = Post::all();

        //Return a view and pass in the variable above.
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Show form
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the data
        $this->validate($request, array(

            'title' => 'required|max:255',
            'body' => 'required'

            ));

        //Store in the db
        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        Session::flash('success', 'New post created!');

        //Redirect to another page (eg. posts.show)
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::find($id);

        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find the post in the db
        $post = Post::find($id);

        //return the view and pass in the variable we previously created.
        return view('posts.edit')->withPost($post);

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
        //Validate the data
        $this->validate($request, array(

            'title' => 'required|max:255',
            'body' => 'required'

            ));

        //Save the data to the db
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $post->save();

        //Set flash data with success message
        Session::flash('success', 'Post successfully updated.');

        //Redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
