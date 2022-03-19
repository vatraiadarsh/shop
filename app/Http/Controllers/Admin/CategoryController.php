<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.category.index',[
            'categories' => Category::all()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);


        // function to create a slug from the string
        function createSlug($string) {
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
            $category->meta_title = $request->input('meta_title');
            $category->meta_description = $request->input('meta_description');
            $category->meta_keywords = $request->input('meta_keywords');

            $category->save();

            if($request->has('ctn')){
                return redirect('/admin/category/create')->with('success', 'Category created successfully');
            }
            else{
                return redirect('/admin/category')->with('success', 'Category created successfully');
            }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
