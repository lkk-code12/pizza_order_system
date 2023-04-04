<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizzaList
    public function pizzaList(Request $request)
    {
        // logger($request->status);
        if ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        } else {
            $data = Product::orderBy('created_at', 'desc')->get();
        }
        return $data;
    }

    //add to cart
    public function addToCart(Request $request)
    {
        // logger($request->all());
        $data = $this->getOrderData($request);
        logger($data);
        Cart::create($data);
        $response = [
            'message' => 'add to cart success',
            'status' => 'complete'
        ];
        return response()->json($response, 200);
    }

    // order
    public function order(Request $request)
    {
        $total = 0;
        // logger($request->all());
        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code']
            ]);
            $total += $data->total;
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        // logger($data->order_code);
        // logger($total + 3000);

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order success'
        ], 200);
    }

    //delete order
    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //clear current product
    public function clearCurrentProduct(Request $request)
    {
        // logger($request->all());
        Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->productId)
            ->where('id', $request->uniqueId)
            ->delete();
    }

    //increase viwe count
    public function increaseViewCount(Request $request){
        // logger($request->all());
        $pizza = Product::where('id',$request->productId)->first();

        $viewCount = [
            'view_count' => $pizza->view_count + 1
        ];
        Product::where('id',$request->productId)->update($viewCount);
    }



    //get order data
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
