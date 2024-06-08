<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CV extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];
    protected $table = 'cvs';
}
