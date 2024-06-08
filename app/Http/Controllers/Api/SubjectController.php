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

}
