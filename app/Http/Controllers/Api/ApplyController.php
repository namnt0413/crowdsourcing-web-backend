<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ApplyRequest;
use App\Services\ApplyService;
use App\Models\Apply;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ApplyController extends Controller
{
    public function create(ApplyRequest $request)
    {
        $todayApply = DB::table('applies')
        ->select(DB::raw('COUNT(applies.id) AS count' ))
        ->where('user_id','=',$request->user_id)
        ->whereRaw( 'DATE(date) = CURRENT_DATE')
        ->first();

        $checkExist = DB::table('applies')
        ->where('user_id','=',$request->user_id)
        ->where('job_id','=',$request->job_id)
        ->whereRaw( 'deleted_at IS NULL')
        ->first();

        if( $todayApply->count < 5 && !isset($checkExist)) {     // max times apply job in a day is 5
            Apply::create($request->validated());
            return response([
                'status' => 200,
                'message' => 'OK'
            ]);
        } else {
            return response([
                'todayApply' => $todayApply,
                'status' => 404,
                'message' => 'Apply to job failed.'
            ]);
        }
    }

    public function delete($id)
    {
        try {
            Apply::find($id)->delete();
            return response([
                'status' => 200,
                'message' => 'OK'
            ]);

        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'delete failed'
            ], 500);
        }

    }

    public function listByJob($job_id)
    {
        $jobApplies = Apply::where('job_id', $job_id)
        ->whereRaw( 'deleted_at IS NULL')
        ->with('job','user')
        ->get();
        // dd($jobApplies);
        return response([
            'data' => $jobApplies,
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    // public function listByCompany($company_id)
    // {
    //     $companyApplies = Apply::where('job_id', $company_id)
    //     ->whereRaw( 'deleted_at IS NULL')->get();
    //     return response([
    //         'data' => $companyApplies,
    //         'status' => 200,
    //         'message' => 'OK'
    //     ]);
    // }

    public function listByUser($user_id)
    {
        $userApplies = Apply::where('user_id', $user_id)
        ->whereRaw( 'deleted_at IS NULL')
        ->with('job')
        ->get();
        return response([
            'data' => $userApplies,
            'status' => 200,
            'message' => 'OK'
        ]);
    }

}
