<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Models\Cart;


class CartController extends Controller
{
    public function AddCart(Request $request,$id){

        $user_id = Auth::id();

        $product= DB::table('products')->where('id',$id)->first();
        $check = DB::table('carts')->where('user_id',$user_id)->where('product_id',$id)->first();
        if($check){
            // return response([
            //     'price'=>$product->price
            // ]);
            $checkId= $check->id;
            $data=array();
         
            $qty =$check->qty+1;
            $data['qty']= $qty;
            

            $data['sub_total']=($qty*$check->product_price);

            DB::table('carts')->where('id',$checkId)->update($data);
            $latestCart = DB::table('carts')
            ->where('user_id',$user_id)
            ->where('order_id',NULL)
            ->get();
                  $total = $latestCart->sum('sub_total');
            return response([
                'message'=>'Product updated to cart',
                 'latestCart'=>$latestCart,
                   'total_price'=>$total,
            ]);
        }else{

            $data = array();
            $data['user_id'] =$user_id;
            $data['order_id'] =null;
            $data['product_id'] =$product->id;
            $data['product_name'] =$product->product_name;
            $data['product_size'] =$product->product_size;
            $data['product_color'] =$product->product_color;
            $data['qty'] =1;
            $data['product_price'] =$product->product_price;
            $data['sub_total'] =$product->product_price*1;
            DB::table('carts')->insert($data);
            $latestCart = DB::table('carts')
            ->where('user_id',$user_id)
            ->where('order_id',NULL)
            ->get();
             $total = $latestCart->sum('sub_total');
            return response([
                'message'=>'Product added to cart',
                'latestCart'=>$latestCart,
                'total_price'=>$total,
            ]);

        }
        
    }

    public function cartQty(Request $request,$id){
  $user_id = Auth::id();
        $cart= Cart::find($id);
        $qty = (int)$request->qty;

    
     // $cart = DB::table('carts')->where('id',$id)->first();
     $cart->qty = $qty;
     $cart->sub_total = $cart->product_price*$qty;
     $cart->save();
     $latestCart = DB::table('carts')->where('user_id',$user_id)->get();
    $total = $latestCart->sum('sub_total');
     return response([
         'message'=>'Quantity updated',
         'latestCart'=>$latestCart,
         'total_price'=>$total,
     ]);
    }


    public function RemoveItem($id){
        $user_id = Auth::id();
        DB::table('carts')->where('product_id',$id)->where('user_id',$user_id)->delete();
          $latestCart = DB::table('carts')
          ->where('user_id',$user_id)
          ->where('order_id',NULL)
          ->get();
           $total = $latestCart->sum('sub_total');

        return response([
            'message'=>'Item removed',
            'latestCart'=>$latestCart,
            'total_price'=>$total,
      

        ]);
    }


    public function RemoveCart(){
        $user_id = Auth::id();
        DB::table('carts')->where('user_id',$user_id)->delete();
        return response([
            'message'=>'cart removed',
            'success'=>true,
        ]);
    }

    public function CartDetails(){
        $user_id = Auth::id();
       $carts= DB::table('carts')
       ->where('user_id',$user_id)
       ->where('order_id',NULL)
       ->get();
  $total = $carts->sum('sub_total');
       return response([
        'data'=>$carts,
        'total_price'=>$total
    ]);
    }

}
