<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all products lists
    // public function productList(){
    //     $products = Product::get();
    //     return response()->json($products,200);
    // }

    //get all categories lists
    public function categoryList()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return response()->json($categories, 200);
    }

    //get all data
    public function allData()
    {
        $data = [
            'carts' => Cart::get(),
            'categories' => Category::get(),
            'contacts' => Contact::get(),
            'orders' => Order::get(),
            'order_list' => OrderList::get(),
            'products' => Product::get(),
            'users' => User::get()
        ];

        return response()->json($data, 200);
        //localhost:8000/api/pizza/system/data
    }

    //create new category
    public function categoryCreate(Request $request)
    {
        // dd($request->all());
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        // return $data;
        $response = Category::create($data);
        return response()->json($response, 200);
    }

    //create new contact
    public function contactCreate(Request $request)
    {
        // dd($request->all());
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        // return $data;
        $contact = Contact::create($data);
        return response()->json($contact, 200);
    }

    //delete category
    public function categoryDelete(Request $request)
    {
        // return $request->all();
        $data = Category::where('id', $request->category_id)->first();

        if (isset($data)) {
            Category::where('id', $request->category_id)->delete();
            return response()->json(['message' => 'successfully deleted'], 200);
        }
        return response()->json(['message' => 'This category does not exist'], 200);
    }

    //category details
    public function categoryDetails($id)
    {
        // return $id->all();
        $data = Category::where('id', $id)->first();

        if (isset($data)) {
            return response()->json(['category' => $data], 200);
        }
        return response()->json(['message' => 'This category does not exist'], 500);
    }

    //category update
    public function categoryUpdate(Request $request)
    {
        // return $request->all();
        $category_id = $request->category_id;

        $dbSource = Category::where('id', $category_id)->first();
        if (isset($dbSource)) {
            $categories = $this->getCategoryData($request);
            // return $categories;
            $response = Category::where('id',$category_id)->update($categories);

            return response()->json(['category'=>$response], 200);
        }
        return response()->json(['message' => 'This category does not exist'], 500);
    }


    //get category data
    private function getCategoryData($request)
    {
        return [
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
