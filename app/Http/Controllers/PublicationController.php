<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use Talam0nal\Readability\Readability;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Publication::with('tags')->paginate(5);
        return response()->json($items);
    }

    /**
     * Search by publication tag
     *
     */
    public function tag($tag)
    {
        $items = Publication::whereHas('tags', function($query) use($tag) {
            $query->where('tag_id', $tag);
        })->get();
        return response()->json($items);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $readability = new Readability();
        $readability = $readability->easeScore($request->text);
        $item = new Publication;
        $item->text = $request->text;
        $item->cover = $request->cover;
        $item->title = $request->title;
        $item->res = $readability;
        $item->save();
        $item->tags()->attach($request->tags);
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Publication::find($id)->with('tags')->get();
        return response()->json($item);

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
        $readability = new Readability();
        $readability = $readability->easeScore($request->text);

        $item = Publication::find($id);
        $item->title = $request->title;
        $item->cover = $request->cover;
        $item->text = $request->text;
        $item->res = $readability;
        $item->save();
        $item->tags()->sync($request->tags);
        $item = Publication::with('tags')->get()->find($id);
        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Publication::find($id);
        $item->tags()->sync([]);
        $item->delete();
        return response()->json(['done']);
    }
}
