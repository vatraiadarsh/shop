<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // search and return view
        $search = request()->query('s');
        if ($search) {
            $products = Product::where('name', 'LIKE', "%{$search}%")
            ->orWhere('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('price', 'LIKE', "%{$search}%")
            ->orWhere('quantity', 'LIKE', "%{$search}%")

            ->paginate(2);
        }else{
            $products = Product::paginate(3);
        }

        return view('admin.product.index', [
            'products' => $products,
            'total_products' => Product::count(),
        ]);

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
    public function store(Request $request)
    {
        // request validation
        $request->validate([
            'name' => 'required|unique:products',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        //check for files
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/product');
            $image->move($destinationPath, $name);
        } else {
            $name = 'not-found.jpg';
        }

        // save to database
        $product = new Product();
        $product->name = $request->input('name');
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->image = $name;

        $product->save();

        return redirect('/admin/product')->with(
            'success',
            'Product created successfully'
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
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
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');

        if($request->has('status')){
            $product->status = $request->input('status');

          }else{
               $product->status = 'off';
          }

        if ($request->hasFile('image')) {
            $destinationPath = public_path('/images/product');
            if (File::exists($destinationPath . $product->image)) {
                File::delete($destinationPath . $product->image);
            }
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $name);
            $product->image = $name;

        }
        $product->update();
        return redirect('/admin/product')->with(
            'success',
            'Product updated successfully'
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
        $product = Product::findOrFail($id);
        $destinationPath = public_path('/images/product');
        if (File::exists($destinationPath . $product->image)) {
            File::delete($destinationPath . $product->image);
        }
        $product->delete();
        return redirect('/admin/product')->with(
            'success',
            'Product deleted successfully'
        );
    }
}
