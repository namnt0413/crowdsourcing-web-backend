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

    public function filterCandidates(Request $request) {
        $candidates = $this->UserService->filterCandidates($request);

        return response([
            'data' => $candidates,
            'status' => 200,
            'message' => 'OK'
        ]);;
    }

    public function getFindingJobUser(Request $request) {
        $candidates = $this->UserService->getFindingJobUser($request);

        return response([
            'data' => $candidates,
            'status' => 200,
            'message' => 'OK'
        ]);;
    }

    public function toggleIsFindingJob(Request $request, User $user) {
        if ( isset($request->user_id) ) {
            $user = User::findOrFail($request->user_id);
            $this->UserService->toggleIsFindingJob($user);
            return response([
                'status' => 200,
                'message' => 'OK'
            ]);
        } else {
            return response([
                'status' => 404,
                'message' => 'Error'
            ]);
        }

    }

}
