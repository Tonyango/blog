<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Tag;
use App\Category; 
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{

    public function __construct() {

      $this->middleware('auth');  

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Create variable and store all blog posts in it from db.
        $posts = Post::orderBy('id', 'desc')->paginate(5);

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
        //Find all categories, store them in a variable and pass them to the view
        $categories = Category::all();

        //Find all tags, store them in a variable and pass them to the view
        $tags = Tag::all();

        //Show form
        return view('posts.create')->withCategories($categories)->withTags($tags);
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
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body' => 'required',
            'featured_image' => 'sometimes|image'

            ));

        //Store in the db
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);

        //Save the post image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $post->image = $filename;

        }

        $post->save();

        $post->tags()->sync($request->tags, false);

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

        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {

            $cats[$category->id] = $category->name;

        }

        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {

            $tags2[$tag->id] = $tag->name;

        }

        //return the view and pass in the variable we previously created.
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);

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
        $post = Post::find($id);

            $this->validate($request, array(

            'title' => 'required|max:255',
            'slug' => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id' => 'required|integer',
            'body' => 'required',
            'featured_image' => 'image'

            ));
        

        //Save the data to the db
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));

        if ($request->hasFile('featured_image')) {

            //Add new photo
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            $oldFilename = $post->image;

            //update the database
             $post->image = $filename;

            //Delete old photo
            Storage::delete($oldFilename);

        }

        $post->save();

        if (isset($request->tags))

            { $post->tags()->sync($request->tags); }
        else
            { $post->tags()->sync(array()); }

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
        //Find item to be deleted
        $post = Post::find($id);

        //detach tag, if any
        $post->tags()->detach();

        //Delete image
        Storage::delete($post->image);

        //Destroy item
        $post->delete();

        //Display flash message
        Session::flash('success', 'Post successfully deleted.');

        //Redirect to posts.index
        return redirect()->route('posts.index');
    }
}
