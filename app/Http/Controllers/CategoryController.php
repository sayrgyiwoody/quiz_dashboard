<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list(){
        $category = Category::when(request('searchKey'),function($query){

            $query->where('name','like','%'.request('searchKey').'%');
        });
        if(request('filterStatus') == "ascending"){
            $category = $category->orderBy('created_at','asc')->paginate(4);
        }else  if(request('filterStatus') == "AZ"){
            $category = $category->orderBy('name','asc')->paginate(4);
        }else {
            $category = $category->orderBy('created_at','desc')->paginate(4);
        }
        return view('category.index',compact('category'));
    }

    //create category
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $category = $this->categoryGetData($request);
        if($request->hasFile('categoryImage')) {
            $categoryImageName = uniqid(). '_' . $request->file('categoryImage')->getClientOriginalName();
            $category['image'] = $categoryImageName;
            $request->file('categoryImage')->storeAs('public/categoryImages',$categoryImageName);
        }

        Category::create($category);
        return redirect()->back()->with(['alert' => 'category Created successfully']);
    }

    //validate category
    private function categoryValidationCheck($request,$id = 0){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'. $id,
            'categoryImage' => 'mimes:png,jpg,jpeg,JPEG,webp|file',

        ])->validate();
    }

     //get data from category input
     private function categoryGetData($request) {
        return [
            'name' => $request->categoryName,

        ];
    }

    //delete category
    public function delete(Request $request) {
        $dbImage = Category::select('image')->where('id',$request->id)->first();
            if($dbImage!=null) {
            $dbImage = $dbImage->image;
                Storage::delete('public/categoryImages/'.$dbImage);
            }
        Category::where('id',$request->id)->delete();
        return back()->with(['alert'=>'Category deleted successfully.']);
    }

    // get edit info
    public function editInfo(Request $request){
        $category = Category::where('id',$request->id)->first();
        return response()->json([
            'category' => $category
        ],200);
    }

    //update category
    public function edit(Request $request) {
        $this->categoryValidationCheck($request,$request->id);
        $data = $this->categoryGetData($request);
        //image check
        if($request->hasFile('categoryImage')) {
            $dbImage = Category::select('image')->where('id',$request->id)->first();
            $dbImage = $dbImage->image;
            if($dbImage!=null) {
                Storage::delete('public/categoryImages/'.$dbImage);
            }
            $imageName = uniqid() . '_' . $request->file('categoryImage')->getClientOriginalName();
            $data['image'] = $imageName;
            $request->file('categoryImage')->storeAs('public/categoryImages/',$imageName);
        }
        Category::where('id',$request->id)->update($data);
        return redirect()->back()->with(['alert'=>'Category updated successfully.']);
    }
}
