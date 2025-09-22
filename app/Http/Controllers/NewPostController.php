<?php

namespace App\Http\Controllers;

use App\Models\new_posts;
use Illuminate\Http\Request;

class NewPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newposts = new_posts::all();
		return view('newposts.index',compact('newposts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newposts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // new_posts::create($request->only(['title','content']));
		// return redirect()->route('newposts.index')->with('success', 'New post created successfully.');

		$newpost = new_posts::create([
			'title' => $request->title,
			'content' => $request->content
		]);
		// dd($post);
		return redirect()->route('newposts.index')->with('success', 'New post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(new_posts $newpost)
    {
        return view('newposts.show', compact('newpost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(new_posts $newpost)
    {
	     return view('newposts.edit', compact('newpost'));

	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, new_posts $newpost)
    {
        $newpost->update($request->only(['title','content']));
		return redirect()->route('newposts.index')->with('success', 'New post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(new_posts $newpost)
    {
        $newpost->delete();
		return redirect()->route('newposts.index')->with('success', 'New post deleted successfully.');
    }
}
