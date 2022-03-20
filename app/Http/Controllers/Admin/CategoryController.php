<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::all(),
            'total_categories' => Category::count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate all the incomming requests
        $request->validate([
            'name' => 'required|unique:categories',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        // function to create a slug from the string
        function createSlug($string)
        {
            $slug = strtolower($string);
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
            return $slug;
        }

        // check for files
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        } else {
            $name = 'not-found.jpg';
        }

        // save to database
        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = createSlug($request->input('name'));
        $category->description = $request->input('description');
        $category->image = $name;


        $category->save();

        return redirect('/admin/category')->with(
            'success',
            'Category created successfully'
        );
    }


        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
       if($request->has('status')){
           $category->status = $request->input('status');

         }else{
              $category->status = 'off';
         }
        if ($request->hasFile('image')) {
            $destinationPath = public_path('/images\/');
            if (File::exists($destinationPath . $category->image)) {
                File::delete($destinationPath . $category->image);
            }
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $name);
            $category->image = $name;
        }
        $category->update();

        return redirect('/admin/category')->with(
            'success',
            'Category updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $destinationPath = public_path('/images\/');
        if (File::exists($destinationPath . $category->image)) {
            File::delete($destinationPath . $category->image);
        }
        $category->delete();
        return redirect('/admin/category')->with(
            'success',
            'Category deleted successfully'
        );
    }
}
