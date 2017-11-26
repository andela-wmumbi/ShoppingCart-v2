<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
/**
 * Cart Controller
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
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
        if (User::where('o_auth_id', 'ilike', $request->o_auth_id)->exists()) {
            return response()->json("authenticated");
        }
        $user = User::create($request->all());

        return response()->json($user, 201);
    }
}
