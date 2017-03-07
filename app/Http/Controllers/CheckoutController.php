<?php

namespace App\Http\Controllers;
use Mail;
use Stripe\Stripe;
use Stripe\Charge;
use Cart;

use Session;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //

    public function  index()
    {
        if(Cart::content()->count() == 0)
        {
           Session::flash('info', 'Your cart still empty .do some shopping');
           return redirect()->back();
        }
        return view('checkout');
    }

    public function pay()
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        Stripe::setApiKey("sk_test_mV0c75C1WoERmJ0Du7NFc9ew");


    // Token is created using Stripe.js or Checkout!
    // Get the payment token submitted by the form:

        //Create a new charge

        $charge =  Charge::create([
            'amount'         => Cart::total() * 100,
            'currency'       =>'usd',
            'description'    => 'book ecommerce',
            'source'         =>request()->stripe_token
        ]);

        Session::flash('success', 'Purchase successfull .Wait for our email');

        Cart::destroy;

        Maill::to(request()->stripeEmail)->send(new\App\Mail\PurchaseSuccessfull);
        return redirect('/');


        //dd(request()->all());
    }
}
