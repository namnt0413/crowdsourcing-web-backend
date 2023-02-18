<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    private $UserService;

    public function __construct( UserService $UserService){
        $this->UserService = $UserService;
    }

    public function updateProfile(UserRequest $request, User $user) {
        $user = User::findOrFail($request->user_id);
        $this->UserService->edit($request, $user);
        return response([
            'status' => 200,
            'message' => 'OK'
        ]);
    }
}
