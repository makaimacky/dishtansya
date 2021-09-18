<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class orderController extends Controller
{
    public function createOrder(Request $request){
        $data=Product::select('quantity')->where([
            ['productid', '=', $request->productid],
              ])->first();
            if((int)$data->quantity < (int)$request->quantity){
                return response()->json(['message'=>'Failed to order this product due to unavailability of the stock'],200);
             }else{
                $Order =  new Order([
                'orderby' => $request->orderby,
                'productid'=>$request->productid,
                'quantity'=>$request->quantity ]);
                $Order->save();
                Product::where('productid', $request->productid)->decrement('quantity', $request->quantity);
                return response()->json(['message'=>'You have successfully ordered this product.'],200);
            }
          
    }
}
