<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class UserService
{
    public function edit($request, $user)
    {
        return $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'birthday'  => $request->birthday,
            'skill'     => $request->skill,
            'school'    => $request->school,
            'work_exp'  => $request->work_exp,
            'favourite' => $request->favourite,
            'activity'  => $request->activity,
            'prize'     => $request->prize,
        ]);
    }

}
