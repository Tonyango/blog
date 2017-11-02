<?php

namespace App\Http\Controllers;

Class PagesController extends Controller {

	public function getIndex() {

		return view ('pages.index');

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

}