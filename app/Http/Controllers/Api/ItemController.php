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
        return response([
            'data' => $item,
            'message' => 'OK'
        ], 200);
    }

    public function updateItemTitle(Request $request, $id) {
        $item = Item::findOrFail($id);
        $item->update([
            'title' => $request->title,
        ]);
        return response([
            'message' => 'OK'
        ], 200);
    }

    public function updateItemContent(Request $request, $id) {
        $item = Item::findOrFail($id);
        $item->update([
            'content' => $request->content,
        ]);
        return response([
            'message' => 'OK'
        ], 200);
    }

}
