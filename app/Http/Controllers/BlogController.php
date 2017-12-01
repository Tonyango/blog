<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;

class BlogController extends Controller
{
	public function getArchive() {

		$posts = Post::paginate(10);

		return view('blog.archive')->withPosts($posts);

	}

    public function getSingle($slug) {

    	//Fetch from the db based on slug
    	$post = Post::where('slug', '=', $slug)->first();

    	//Return the view and pass in the post object
    	return view('blog.single')->withPost($post);

    }
}
