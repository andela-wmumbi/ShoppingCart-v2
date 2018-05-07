<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
/**
 * Cart Controller
 *
 * @package App\Http\Controllers
 */
class CartController extends Controller
{
    /**
     * Add item to cart
     *
     * @param object $request request
     *
     * @return object
     */
    public function add(Request $request)
    {
        $cart = Session::get('cart');

        if (isset($cart[$request->id]) ) {
            return response()->json("Item already in cart");
        }
        $cart[$request->id] = $request->quantity;
        Session::put('cart', $cart);

        $cart = Session::get('cart');

        $cookie = Array("cookie" => $_COOKIE['laravel_session']);

        return response()->json($cookie);
    }

    /**
     * Get all items in cart
     * @param object $request request
     *
     * @return object
     */

    public function all(Request $request)
    {
        $cart = Session::get('cart');
        return response()->json($cart);
    }


     /**
     * Delete all items in cart
     * @param object $request request
     *
     * @return object
     */

    public function delete(Request $request,$id)
    {
       $cart = Session::get('cart');
    unset($cart[intval($id)]);
       return response()->json($cart);

    }
}
