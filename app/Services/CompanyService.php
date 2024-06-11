<?php

namespace App\Services;

use App\Models\Company;
use Carbon\Carbon;

class CompanyService
{

    public function findOrFailById($id)
    {
        $company = Company::findOrFail($id);
        return $company;
    }

    public function edit($request, $company)
    {
        return $company->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'avatar_url'=> $request->avatar_url,
            'address'   => $request->address,
            'description' => $request->description,
        ]);
    }

    public function getAllCompanies()
    {
        $companies = Company::select('*')->take(30)->with("city")->get();
        return $companies;
    }

    public function detailCompany($id) {
        $company = Company::where(["id" => $id])->get();
        return $company;
    }

}
