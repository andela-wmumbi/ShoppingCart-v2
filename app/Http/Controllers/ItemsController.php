<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ItemsController
 *
 * @package App\Http\Controllers
 */
class ItemsController extends Controller
{
    /**
     * Get all items
     *
     * @return object response of all gotten items
     */
    public function all()
    {
        $items = Items::all();

        return response()->json($items);
    }

    /**
     * Get one item
     *
     * @param object  $request request
     * @param integer $id      unique id of an item
     *
     * @return object  response of one item
     */
    public function oneItem(Request $request, $id)
    {
        $item = Items::find($id);
        if (!$item) {
            return response()->json(["error" => "Item not found"], 404);
        }
        return response()->json($item);
    }

    /**
     * Adds a new item
     *
     * @param object $request request
     *
     * @return Object
     */
    public function add(Request $request)
    {
        if (Items::where('name', $request->input('name'))->exists()) {
            return response()->json("Item already exists");
        }
        $item = Items::create($request->all());

        return response()->json($item);
    }

    /**
     * Update an item
     *
     * @param object  $request request
     * @param integer $id      unique id of an item to update
     *
     * @return Object
     */
    public function update(Request $request, $id)
    {
        $item = Items::find($id);
        if (!$item) {
            return response()->json(["error" => "Item not found"], 404);
        }
        $item->name = $request->input('name');
        $item->stock = $request->input('stock');
        $item->price = $request->input('price');
        $item->save();

        return response()->json($item);
    }

    /**
     * Delete an item
     *
     * @param object  $request request
     * @param integer $id      unique id of an item to delete
     *
     * @return Object
     */
    public function delete(Request $request, $id)
    {
        $item = Items::find($id);

        if (!$item) {
            return response()->json(["error" => "Item not found"], 404);
        }
        $item->delete();

        return response()->json($item);
    }
}
