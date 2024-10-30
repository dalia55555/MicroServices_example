<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{
    public function create (CreateProductRequest $request){

        $Product = Product::create([
            'name'=> $request->name,
            'price' => $request->price,
        ]);
        if(!$Product){
            return response()->json(['message'=> 'error happen'], 400);
        }
        return response()->json(['message'=> 'Product created successfuly'], 200);
    }

    public function get(){
        $Products = Product::all();
        if(!$Products){
            return response()->json(['message'=> 'no data found'], 400);
        }
        return response()->json(['data'=>$Products], 200);
    }

    public function find($id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(['message'=> 'no data found with this id'], 400);
        }
        return response()->json(['data'=>$product], 200);
    }
}
