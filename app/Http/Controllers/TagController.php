<?php

namespace App\Http\Controllers;

use App\Forms\TagForm;
use App\Http\Requests\TagStoreRequest;
use App\Tag;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tag::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagStoreRequest $request)
    {
        $validated = $request->validated();

        Tag::create($validated);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return $tag;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag $tag
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(TagForm::class, [
            'method' => 'PUT',
            'url' => route('tags.update', $tag),
            'model' => $tag
        ]);

        return view('tags.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagStoreRequest $request, Tag $tag)
    {
        $validated = $request->validated();

        $tag->update($validated);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->tasks()->detach();

        $result = $tag->delete();

        return response()->json($result);
    }
}
