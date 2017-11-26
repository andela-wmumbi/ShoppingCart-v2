<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
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
        $cart = array($request->id => $request->quantity);
        $data = Redis::set('cart', json_encode($cart));

        // $request->session()->push('cart', $cart);
        $data = Redis::get('cart');

        return $data;
    }

    /**
     * Get all items in cart
     * @param object $request request
     *
     * @return object
     */

    public function all(Request $request)
    {
        $data = Redis::get('cart');
        return $data;
    }

     /**
     * Delete all items in cart
     * @param object $request request
     *
     * @return object
     */

    public function delete(Request $request)
    {
        $data = $request->session()->flush();
        return response()->json($data);
    }
}
