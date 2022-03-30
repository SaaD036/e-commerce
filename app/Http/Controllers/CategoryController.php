<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    //
    public function index(){
        $categories = Category::select()->get();

        return view('Admin.Category.category', compact('categories'));
    }
    public function edit(Request $request, $id){
        $category = Category::select()
                        ->where('id', '=', $id)
                        ->first();

        // return $categories;
        // $category = $categories[0];
        return $category;
        return view('Admin.Category.editCategory', compact('category'));
    }
    public function update(Request $request, $id){
        if($request->name){
            Category::where('id', '=', $id)
                ->update(["name" => $request->name]);
        }
        if($request->parent_id){
            Category::where('id', '=', $id)
                ->update(["parent_id" => $request->parent_id]);
        }
        if($request->description){
            Category::where('id', '=', $id)
                ->update(["description" => $request->description]);
        }

        return redirect()->route('category');
    }
    public function delete($id){
        Category::where('id', '=', $id)
                ->delete();

        return redirect()->route('category');
    }
    public function create_category(){
        return view('Admin.Category.createCatagory');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:250',
            'parent_id' => 'required'
        ]);

        $categories = Category::select()
                    ->where('name', '=', $request->name)
                    ->get();

        if(!$categories->isEmpty()){
            return redirect()->route('category');
        }

        $category = new Category;
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;

        if($request->image){
            $category->image = $request->image;
        }
        else{
            $category->image = "";
        }

        $category->save();

        return redirect()->route('category');
    }

}
