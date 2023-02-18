<?php

namespace App\Services;

use App\Models\Job;
use Carbon\Carbon;

class JobService
{
    public function create($request)
    {
        return Job::create($request);
    }

    public function edit($request, $job)
    {
        return $job->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'budget'        => $request->budget,
            'requirement'   => $request->requirement,
            'category_id'   => $request->category_id,
            'position_id'   => $request->position_id,
            'city_id'       => $request->city_id,
            'deadline'      => $request->deadline,
        ]);

    }

    public function findOrFailById($id) {
        $job = Job::findOrFail($id);
        return $job;
    }

    public function getAllJobs()
    {
        $jobs = Job::select('*')->with('company','category','city','position')->get();
        return $jobs;
    }

    public function getCompanyJobs($company_id)
    {
        $jobs = Job::where('company_id', $company_id)->get();
        return $jobs;
    }

    public function filterJobs($request) {
        return Job::query()
        ->title($request)
        ->category($request)
        ->position($request)
        ->city($request)
        ->get();
    }

}
