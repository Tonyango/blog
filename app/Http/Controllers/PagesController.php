<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Mail;
use Session;

Class PagesController extends Controller {

	public function getIndex() {

		$posts = Post::orderBy('created_at', 'desc')->limit(4)->get();

		return view ('pages.index')->withPosts($posts);

	}

	public function getAbout() {

		$first = 'Tony';
		$last = 'Onyango';

		$fullname = $first . ' ' . $last;
		$email = 'onyangodot@gmail.com';
		$age = '25';
		$month = 'April';

		$data = [];
		$data['age'] = $age;
		$data['month'] = $month;


		return view ('pages.about')->withFullname($fullname)->withEmail($email)->withData($data);
		
	}

	public function getContact() {

		return view ('pages.contact');
		
	}

	public function postContact(Request $request) {

		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10']);

		$data = array(

			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message

			);

		Mail::send('emails.contact', $data, function($message) use ($data) {

				$message->from($data['email']);
				$message->to('onyangodot@gmail.com');
				$message->subject($data['subject']);

		});

		Session::flash('success', 'Email sent!');

		return redirect('/');

	}

}