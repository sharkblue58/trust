<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
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
            'session_id' => 'required|numeric',

            'quantity' => 'required|numeric',

        ]);

        // Get the product from the database.

        $product = Product::findOrFail($request->product_id);

        // Check if the cart already has an item with the same product id.

         $cartItem = Cart::where('product_id')->where('product_id', $request->product_id)->first();

        if ($cartItem=$product ) {  // If it does, update the quantity.

            // $caremtIt ->quantity += $request->quantity;  // Add new quantity to existing quantity. 
            // $cartItem ->quantity += $request->quantity;

            // $cartItem ->save();  // Save the updated cart item.  
            $cartItem = Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity, // add quantity here 
            ));


        }
        else{Cart::create([   // Create a new cart item with user id, product id and quantity from request data.  

      
            'product_id' => $request->product_id,  
            'session_id' => $request->session_id,
            'quantity' => $request->quantity,  

        ]);
    
    }
        
    
    
    
    
    
    
    }


    public function show( Request $Cart,$id)
    {
       
        $Cart=Cart::find($id);
       
        // $product=Product::find($id);
        // return  new   ProductsResource($product);
        return  new   CartResource($Cart);


    }




















    // public function store(Request $request) 
    // {

    //     // Validate the request data.

    //     $this->validate($request, [

    //         'product_id' => 'required|numeric',
    //         'session_id' =>'required|numeric',
    //         'quantity' => 'required|numeric',

    //     ]);

    

    //         Cart::create([   // Create a new cart item with user id, product id and quantity from request data.  

    //             // 'user_id' => Auth::id(),  


    //             'product_id' => $request->product_id,  
    //             'session_id' =>$request->session_id,  
    //             'quantity' => $request->quantity,  

               

    //         ]);  







      
   
    
    
    
    public function update( Request $request, Cart $Cart)
    {
        // if(Auth::user()->id !== $Category->user_id) {
        //     return $this->error('', 'You are not authorized to make this request', 403);
        // }
        $Cart->update($request->all());
        return new CartResource($Cart);;

      
    }

    public function destroy(Cart $Cart)
    {
        return  $Cart->delete();
    }


    
    public function add(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);
    
        // Get the product from the database
        $product = Product::findOrFail($request->product_id);
    
        // Add the product to the cart
        Cart::add([
            'id' => $product->id, 
            'name' => $product->name, 
           
            'quantity' => $request->quantity, 
         
        ]);
    
    
    
    
    
    }}
        
       
    // public function addToCart(Request $request) 
    // {

    //     // Validate the request data.

    //     $this->validate($request, [

    //         'product_id' => 'required|numeric',

    //         'quantity' => 'required|numeric',

    //     ]);

    //     // Get the product from the database.

    //     $product = Product::findOrFail($request->product_id);

    //     // Check if the cart already has an item with the same product id.

    //     $cartItem = ->where('product_id', $request->product_id)->first();

    //     if ($cartItem) {  // If it does, update the quantity.

    //         $cartItem->quantity += $request->quantity;  // Add new quantity to existing quantity. 

    //         $cartItem->save();  // Save the updated cart item.  

    //     }