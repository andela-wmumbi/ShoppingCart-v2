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
        $request->session()->push($request->id, $request->quantity);
        $data = $request->session()->all();
        return $data;
    }
}
