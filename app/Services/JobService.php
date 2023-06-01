<?php

namespace App\Services;

use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function detailJob($id) {
        $job = Job::where(["id" => $id])
        ->with('company','category','city','position')->get();
        return $job;
    }

    public function findOrFailById($id) {
        $job = Job::findOrFail($id);
        return $job;
    }


    public function getAllJobs()
    {
        return $jobs = Job::selectRaw( '* , DATEDIFF(`jobs`.`deadline`, NOW()) as `remaining_date`')
        ->where(["status" => 1])
        ->whereRaw( 'deadline >= NOW()')
        ->with('company','category','city','position')->withCount('apply')->get();
    }

    public function getCompanyJobs($company_id, $request)
    {
        if( isset($request->company_id) ) {
            $jobs = Job::selectRaw( '* , DATEDIFF(`jobs`.`deadline`, NOW()) as `remaining_date`')
            ->where('company_id', $company_id)->with('company','category','city','position')->withCount('apply')->get();
            return $jobs;
        } else {
            $jobs = Job::selectRaw( '* , DATEDIFF(`jobs`.`deadline`, NOW()) as `remaining_date`')
            ->where('company_id', $company_id)->where(["status" => 1])
            ->whereRaw( 'deadline >= NOW()')->with('company','category','city','position')->withCount('apply')->get();
            return $jobs;
        }
    }

    public function filterJobs($request)
    {
        return Job::query()
        ->selectRaw( '* , DATEDIFF(`jobs`.`deadline`, NOW()) as `remaining_date`' )
        ->title($request)
        ->category($request)->position($request)->city($request)
        ->where(["status" => 1])->whereRaw( 'deadline >= NOW()')
        ->with('company','category','city','position')->withCount('apply')->get();
    }

    public function toggleStatusJob(Job $job)
    {
        if ($job->status == 1 )
         {
            return $job->update([
                'status' => 0
            ]);
        } else {
            return $job->update([
                'status' => 1
            ]);
        }
    }

}
