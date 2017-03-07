<?php

namespace App\Http\Controllers;

use Session;

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
        Session::flash('success', 'Product added to cart');

       return redirect()->route('cart');

    }

    public function cart()
    {


        return view('cart');
    }

    public  function  cart_delete($id)
    {
        Cart::remove($id);

        Session::flash('success', 'Product removed from cart');
        return redirect()->back();
    }

    public function  incr($id, $qty)
    {
       Cart::update($id,$qty +1 ) ;

       Session::flash('success', 'Product qty update');
       return redirect()->back();
    }

    public function  decr($id, $qty)
    {
        Cart::update($id,$qty -1 ) ;

        Session::flash('success', 'Product qty update');

        return redirect()->back();
    }

    public function  rapid_add($id)
    {


        // Add Item to the Cart
        $pdt = Product::find($id);

        $cartItem =  Cart::add([
            'id'    => $pdt->id,
            'name'  => $pdt->name,
            'qty'   =>1,
            'price' =>$pdt->price
        ]);

        Cart::associate($cartItem->rowId, 'App\Product');  // Display an image to cart Page

        Session::flash('success', 'Product added to cart');

        return redirect()->route('cart');

    }
}

// dd($cart);  dd(Cart::content());  //        dd(request()->all());  Cart::destroy();
