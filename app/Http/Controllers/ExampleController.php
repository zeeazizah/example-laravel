<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index(Request $request, $id)
	{
		$type = $request->query('type');
		// return 'ini adalah index dengan id '.  $id . ' dan type ' . $type;

		return view('example', [
			'id' => $id,
			'type' => $type
		]);
	}
}