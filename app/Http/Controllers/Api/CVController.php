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

    public function updateTitle(Request $request, $id) {
        $cv = CV::findOrFail($id);
        $cv->update([
            'title' => $request->field,
        ]);
        return response([
            'message' => 'OK'
        ], 200);
    }

    public function updatePosition(Request $request, $id) {
        $cv = CV::findOrFail($id);
        $cv->update([
            'position' => $request->field,
        ]);
        return response([
            'message' => 'OK'
        ], 200);
    }

    public function updateEmail(Request $request, $id) {
        $cv = CV::findOrFail($id);
        $cv->update([
            'email' => $request->field,
        ]);
        return response([
            'message' => 'OK'
        ], 200);
    }

    public function updatePhone(Request $request, $id) {
        $cv = CV::findOrFail($id);
        $cv->update([
            'phone' => $request->field,
        ]);
        return response([
            'message' => 'OK'
        ], 200);
    }

    public function updateBirthday(Request $request, $id) {
        $cv = CV::findOrFail($id);
        $cv->update([
            'birthday' => $request->field,
        ]);
        return response([
            'message' => 'OK'
        ], 200);
    }

    public function updateAddress(Request $request, $id) {
        $cv = CV::findOrFail($id);
        $cv->update([
            'address' => $request->field,
        ]);
        return response([
            'message' => 'OK'
        ], 200);
    }

    public function detail($id)
    {
        $cv = CV::where(["id" => $id])->first();
        // dd($cv);
        return response([
            'data' => $cv,
            'message' => 'OK'
        ], 200);
    }


}
