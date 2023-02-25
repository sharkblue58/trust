<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CartResource;
use App\Http\Resources\ProductsResource;

class CartController extends Controller 
{

    public function index()
    {
        return CartResource::collection(
            Cart::all()
        );
    }
    public function store(Request $request) 
    {

        // Validate the request data.

        $this->validate($request, [

            'product_id' => 'required|numeric',

            'quantity' => 'required|numeric',
            'session_id' => 'required|numeric',


        ]);
 
        $product =Product::findOrFail( $request->product_id);


        $cartItem = Cart::where('session_id', Session()->all())->where('product_id', $request->product_id)->first();

        if ($cartItem) {  // If it does, update the quantity.

            $cartItem->quantity += $request->quantity;  // Add new quantity to existing quantity. 

            $cartItem->save();  // Save the updated cart item.  

        } else {  // If it doesn't, create a new cart item.  

            Cart::create([   // Create a new cart item with user id, product id and quantity from request data.  

                'session_id' =>$request->session_id,  

                'product_id' => $request->product_id,  

                'quantity' => $request->quantity,  

            ]);  

        }   return  new ProductsResource($product);}
    }
      
        //   public function removeFromCart(Request $request){    
        //          // Validate the request data.  
        //         $this->validate($request, [         
        //                 'cart_item_id' => 'required|numeric',         ]);    
        //                         // Get the cart item from database using its id from request data.       
        //                 $cartItem = Cart::findOrFail($request->cart_item_id);     
        //             if ($cartItem && Auth::check() && Auth::user()->id == $cartItem->user_id) {           
        //                 // Delete the cart item if user is authenticated and is owner of this cart item.    
        //     $cartItem->delete();              return back()->with('success', "Product removed from your cart!");         } 
        //     else {             return back()-withErrors(['msg' => "You don't have permission to delete this product."]);         }     }}