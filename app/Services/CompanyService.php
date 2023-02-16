<?php

namespace App\Services;

use App\Models\Company;
use Carbon\Carbon;

class CompanyService
{

    public function findOrFailById($id) {
        $company = Company::findOrFail($id);
        return $company;
    }


}
