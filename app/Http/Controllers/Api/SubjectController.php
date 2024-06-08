<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\SubjectRequest;
use App\Models\Subject;


class SubjectController extends Controller
{
    public function create(SubjectRequest $request) {
        Subject::create($request->validated());
        return response([
            'message' => 'create new subject success'
        ], 200);
    }

    public function detail($id)
    {
        $subject = Subject::where(["id" => $id])->first();
        // dd($cv);
        return response([
            'data' => $subject,
            'message' => 'OK'
        ], 200);
    }

}
