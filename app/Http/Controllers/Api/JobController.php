<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\JobRequest;
use App\Models\Job;
use App\Services\JobService;
use App\Services\CompanyService;

class JobController extends Controller
{

    private $jobService;

    public function __construct( JobService $jobService , CompanyService $companyService ){
        $this->jobService = $jobService;
        $this->companyService = $companyService;
    }

    public function create(JobRequest $request)
    {
        $this->jobService->create($request->validated());
        return response([
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $job = $this->jobService->findOrFailById($id);
        if( $request->company_id != '' ) {
            $company = $this->companyService->findOrFailById($request->company_id);
            if( $company->can('edit', $job)) {
                $this->jobService->edit($request, $job);
                return response([
                    'status' => 200,
                    'message' => 'OK'
                ]);
            } else {
                return response([
                    'status' => 404,
                    'message' => 'Do not have permission'
                ]);
            }
        } else {
            return response([
                'status' => 404,
                'message' => 'Please sign in/up company account to do this action'
            ]);
        }

    }

    public function delete(Request $request, $id)
    {
        $job = $this->jobService->findOrFailById($id);
        if( $request->company_id != '' ) {
            $company = $this->companyService->findOrFailById($request->company_id);
            if( $company->can('delete', $job)) {
                $job->delete();
                return response([
                    'status' => 200,
                    'message' => 'OK'
                ]);
            } else {
                return response([
                    'status' => 404,
                    'message' => 'Do not have permission'
                ]);
            }

        } else {
            return response([
                'status' => 404,
                'message' => 'Please sign in/up company account to do this action'
            ]);
        }

    }

    public function detail($id)
    {
        $job = $this->jobService->detailJob($id);
        return response([
            'data' => $job,
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    public function getAllJobs()
    {
        $jobs = $this->jobService->getAllJobs();
        return response([
            'data' => $jobs,
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    public function getCompanyJobs(Request $request, $company_id)
    {
        $jobs = $this->jobService->getCompanyJobs($company_id, $request);
        return response([
            'data' => $jobs,
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    public function filterJobs(Request $request)
    {
        $jobs = $this->jobService->filterJobs($request);

        return response([
            'data' => $jobs,
            'status' => 200,
            'message' => 'OK'
        ]);;
    }

    public function toggleStatusJob(Request $request)
    {
        if ( isset($request->job_id) ) {
            $job = Job::findOrFail($request->job_id);
            $this->jobService->toggleStatusJob($job);
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
