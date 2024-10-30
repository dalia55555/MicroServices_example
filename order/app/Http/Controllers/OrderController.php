<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Requests\CreateOrderRequest;
use App\Services\ProductClient;

class OrderController extends Controller
{
    protected $productClient;

    public function __construct(ProductClient $productClient)
    {
        $this->productClient = $productClient;
    }

    public function create (CreateOrderRequest $request){

        $product = $this->productClient->getProductById($request->product_id);
        $price = data_get($product, 'data.price');
        $order = Order::create([
            'product_id'=> $request->product_id,
            'total_price' => $request->count * $price,
            'count' => $request->count
        ]);
        if(!$order){
            return response()->json(['message'=> 'error happen'], 400);
        }
        return response()->json(['message'=> 'order created successfuly'], 200);
    }

    public function get(){
        $orders = Order::all();
        if(!$orders){
            return response()->json(['message'=> 'no data found'], 400);
        }
        return response()->json(['data'=>$orders], 200);
    }

    public function find($id){
        $order = Order::find($id);
        if(!$order){
            return response()->json(['message'=> 'no data found with this id'], 400);
        }
        return response()->json(['data'=>$order], 200);
    }
}
