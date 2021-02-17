<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    public function OrderDetails(){
            $user_id = Auth::id();
            $product= DB::table('carts')
            ->where('user_id',$user_id)
             ->where('order_id',NULL)
            ->get();
            $total = $product->sum('sub_total');
            return response([
            'data'=>$product,
            'total_price'=>$total,
        ]);

        }

       public function OrderStore(Request $request){
         $user_id = Auth::id();
        $data = array();
        $data['shipping_address']=$request->shipping_address;
        $data['user_id']= $user_id;
        $data['payment_id']=$request->payment_id;
        $data['order_number']='#lara-00'.$request->id;
        DB::table('orders')->insert($data);
       $carts=Cart::where('user_id',$user_id)
       ->where('order_id',NULL)
       ->get();
       $order= Order::latest()->first();
 

        foreach($carts as $cart){

            $cart->order_id = $order->id;
            $cart->save();
        }
        return response()->json([
            'message'=>'Ordered successfull',
            'success'=>true,
        ]);

        }
    }

