<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    private $CompanyService;

    public function __construct( CompanyService $CompanyService)
    {
        $this->CompanyService = $CompanyService;
    }

    public function updateInfo(CompanyRequest $request, Company $company)
    {
        $company = Company::findOrFail($request->company_id);
        $this->CompanyService->edit($request, $company);
        return response([
            'status' => 200,
            'message' => 'OK'
        ]);
    }

    public function getAllCompanies ()
    {
        $companies = $this->CompanyService->getAllCompanies();
        if ( $companies ) {
            return response([
                'data' => $companies,
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

    public function detail($id)
    {
        $company = $this->CompanyService->detailCompany($id);
        return response([
            'data' => $company,
            'message' => 'OK'
        ],200);
    }

}
