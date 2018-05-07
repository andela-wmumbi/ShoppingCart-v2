<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ItemsController
 *
 * @package App\Http\Controllers
 */
class ItemController extends Controller
{
    /**
     * Get all items
     *
     * @return object response of all gotten items
     */
    public function all()
    {
        $items = Item::all();

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
        try {
            $arr = explode(',', $id);
            foreach ($arr AS $index => $value)
            $arr[$index] = (int)$value;

            $item = Item::findMany($arr);
            if (!$item) {
                return response()->json(["error" => "Item not found"], 404);
            }
            return response()->json($item);
        } catch (ModelNotFoundException $exception) {
            return $this->respond(Response::HTTP_NOT_FOUND, ["message" => "The request was not found"]);
        }
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
        if (Item::where('name', $request->input('name'))->exists()) {
            return response()->json("Item already exists");
        }
        $item = Item::create($request->all());

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
        $item = Item::find($id);
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
        $item = Item::find($id);

        if (!$item) {
            return response()->json(["error" => "Item not found"], 404);
        }
        $item->delete();

        return response()->json($item);
    }
}
