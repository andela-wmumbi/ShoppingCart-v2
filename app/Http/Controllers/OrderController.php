<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class OrdersController
 *
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    /**
     * Get all orders
     *
     * @param object $request request
     *
     * @return object json object
     */
    public function all(Request $request)
    {
        $order = Order::all();

        return response()->json($order);
    }

    /**
     * Get one order
     *
     * @param object  $request request
     * @param integer $id      unique id of an item
     *
     * @return object  response of one item
     */
    public function oneOrder(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(["error" => "Order not found"], 404);
        }
        return response()->json($order);
    }

    /**
     * Adds an order
     *
     * @param object $request request
     *
     * @return Object
     */
    public function add(Request $request)
    {
        $this->validate($request, Order::$rules);

        if (Order::where('id', $request->input('id'))->exists()) {
            return response()->json("Order already exists");
        }
        $order = Order::create($request->all());

        return response()->json($order, 201);
    }

    /**
     * Update an order
     *
     * @param object  $request request
     * @param integer $id      unique id of an order to update
     *
     * @return Object
     */
    public function update(Request $request, $id)
    {
        $this->validate($id, Order::$rules);

        $order = Order::find($id);
        if (!$order) {
            return response()->json(["error" => "Order not found"], 404);
        }
        $order->address = $request->input('address');
        $order->phone_number = $request->input('phone_number');
        $order->save();

        return response()->json($order);
    }

    /**
     * Delete an order
     *
     * @param object  $request request
     * @param integer $id      unique id of an order to delete
     *
     * @return Object
     */
    public function delete(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(["error" => "Order not found"], 404);
        }
        $order->delete();

        return response()->json($order);
    }
}
