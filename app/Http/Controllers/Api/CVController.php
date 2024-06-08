<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CV;
use App\Http\Requests\Api\CVRequest;
use Illuminate\Http\Request;

class CVController extends Controller
{
    public function create(CVRequest $request) {
        CV::create($request->validated());
        return response([
            'message' => 'create new cv success'
        ], 200);
    }

    public function updateName(Request $request, $id) {
        $cv = CV::findOrFail($id);
        $cv->update([
            'name' => $request->name,
        ]);
        return response([
            'message' => 'OK'
        ], 200);
    }
    // public function updateName() {

    // }
    // public function updateName() {

    // }
    // public function updateName() {

    // }

    public function detail($id)
    {
        $cv = CV::where(["id" => $id])->first();
        return response([
            'data' => $cv,
            'message' => 'OK'
        ], 200);
    }


}
