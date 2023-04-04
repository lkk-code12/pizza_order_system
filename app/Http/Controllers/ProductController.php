<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list(){
        $products = Product::select('products.*','categories.name as category_name')
                    ->when(request('key'),function($query){
                        $query->where('products.name','like','%'.request('key').'%');
                    })
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->orderBy('products.created_at','desc')
                    ->paginate(3);
        // dd($products->toArray());
        $products->appends(request()->all());
        return view('admin.product.pizzaList',compact('products'));
    }


    //direct product create
    public function createPage(){
        $categories = Category::select('id','name')->get();
        // dd($categories->toArray());
        return view('admin.product.create',compact('categories'));
    }

    //product add
    public function create(Request $request){
        // dd($request->all());
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductInfo($request);

        // if($request->hasFile('productImage')){
            $fileName = uniqid().$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public',$fileName); //store image in project
            $data['image'] = $fileName; //store image in database
        // }

        Product::create($data);
        return redirect()->route('product#list');
    }

    //product view
    public function view($id){
        $products = Product::select('products.*','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->where('products.id','like',$id)->first();
        return view('admin.product.view',compact('products'));
    }

    //product updatePage
    public function updatePage($id){
        $products = Product::where('id','like',$id)->first();
        $categories = Category::get();
        return view('admin.product.update',compact('products','categories'));
    }

    //product update
    public function update(Request $request){
        $this->productValidationCheck($request,'update');
        $data = $this->requestProductInfo($request);
        // dd($data);

        if($request->hasFile('image')){
            $oldImageName = Product::where('id',$request->productId)->first();
            $oldImageName = $oldImageName->image;
            // dd($oldImageName);

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Product::where('id',$request->productId)->update($data);
        return redirect()->route('product#list');
    }

    //product delete
    public function delete($id){
        Product::where('id','like',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product has been deleted.']);
    }

    //product validation check
    private function productValidationCheck($request, $action){
        $validationRules = [
            'productName' => 'required|min:5|unique:products,name,'.$request->productId,
            'productCategory' => 'required',
            'productDescription' => 'required|min:10',

            'productPrice' => 'required',
            'productWaitingTime' => 'required'
        ];

        $validationRules['productImage'] = $action == 'create' ? 'required|mimes:jpg,jpeg,png|file' : 'mimes:jpg,jpeg,png|file';

        Validator::make($request->all(),$validationRules)->validate();
    }

    //product request info
    private function requestProductInfo($request){
        return [
            'category_id' => $request->productCategory,
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'waiting_time' => $request->productWaitingTime
        ];
    }
}
