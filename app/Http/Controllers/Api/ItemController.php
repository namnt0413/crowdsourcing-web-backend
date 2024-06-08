<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    public function create(ItemRequest $request) {
        Item::create($request->validated());
        return response([
            'message' => 'create new subject success'
        ], 200);
    }

}
