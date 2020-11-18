<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        return Blog::all();
    }

    public function show($id){
        $blog = Blog::find($id);
        if($blog){
            return response()->json([
                'message' => 'Menampilkan blog sesuai id',
                'data' => $blog
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Blog not found'
            ], 404);
        }
    }
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'content' => 'required'
        ]);
        $blog = Blog::create(
            $request->only(['title', 'author', 'content'])
        );
        return response()->json([
            'created' => true,
            'data' => $blog
        , 201]);
    }
    public function update(Request $request, $id) {
        try {
            $blog = Blog::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not found'
            , 404]);
        }
        $blog->fill(
            $request->only(['title', 'author', 'content'])
        );
        $blog->save();
        return response()->json([
            'updated' => true,
            'data' => $blog
        ], 200);
    }

    public function destroy($id){
        try {
            $blog = Blog::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not found'
            , 404]);
        }
        $blog->delete();
        return response()->json([
            'deleted' => true
        ], 200);
    }
}
