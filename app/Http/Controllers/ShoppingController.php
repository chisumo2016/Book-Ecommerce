<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use Cart;

class ShoppingController extends Controller
{
    //

    public  function  add_to_cart()
    {

       // Add Item to the Cart
        $pdt = Product::find(request()->pdt_id);

       $cartItem =  Cart::add([
            'id'    => $pdt->id,
            'name'  => $pdt->name,
            'qty'   =>request()->qty,
            'price' =>$pdt->price
        ]);

       Cart::associate($cartItem->rowId, 'App\Product');  // Display an image to cart Page

       return redirect()->route('cart');

    }

    public function cart()
    {


        return view('cart');
    }

    public  function  cart_delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }
}

// dd($cart);  dd(Cart::content());  //        dd(request()->all());  Cart::destroy();
