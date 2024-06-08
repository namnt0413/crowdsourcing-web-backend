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
            'message' => 'create new item success'
        ], 200);
    }

    public function detail($id)
    {
        $item = Item::where(["id" => $id])->first();
        // dd($cv);
        return response([
            'data' => $item,
            'message' => 'OK'
        ], 200);
    }

}
