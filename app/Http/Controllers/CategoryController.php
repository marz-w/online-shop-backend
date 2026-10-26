<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createCategory(Request $request){

    $request->validate([
        'name'=> 'required|string|unique:categories,name',
        'description'=> 'string|max:1000'
    ]);

    $category = new Category();
    $category->name = $request->name;
    $category->description = $request->description;

    try{
        $category->save();
        return response()->json([
            'message'=>'Category saved successfully',
            'category'=>$category
        ],200);

    }catch(\Exception $e){
        $category->save();
        return response()->json([
            'message'=>'Failed to save',
            'error'=>$e->getMessage()
        ],500);

    }

    }

    public function readAll(){
        try{
            $categories = Category::all();
            return response()->json([
                'categories'=>$categories
            ],200);
        } catch(\Exception $e){
        return response()->json([
            'message'=>'Failed to fetch',
            'error'=>$e->getMessage()
        ],500);
    }
    }

    public function read($id){
        try{
            $category = Category::where('id', $id) ->first();
            return response()->json([
                'category'=>$category
            ],200);
        } catch(\Exception $e){
        return response()->json([
            'message'=>'Failed to fetch',
            'error'=>$e->getMessage()
        ],500);
    }
    }

    public function updateCategory($id, Request $request){

    $request->validate([
        'name'=> 'required|string',
        'description'=> 'string|max:1000'
    ]);

    $category = category::where('id', $id)->first();
    $category->name = $request->name;
    $category->description = $request->description;

    try{
        $category->save();
        return response()->json([
            'message'=>'Category updated successfully',
            'category'=>$category
        ],200);

    }catch(\Exception $e){
        $category->save();
        return response()->json([
            'message'=>'Failed to update',
            'error'=>$e->getMessage()
        ],500);

    }

    }
    public function deleteCategory($id){
        try{
            $category = Category::where('id', $id)->first();
            if($category){
                $category->delete();
            return response()->json('Category deleted successfully');
            } else {
                return response()->json('Category not found');
            }
        } catch(\Exception $e){
        return response()->json([
            'message'=>'Failed to delete',
            'error'=>$e->getMessage()
        ],500);
    }
    }
}
