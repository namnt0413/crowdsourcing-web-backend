<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];
    protected $table = 'jobs';

    public function scopeTitle($query, $request)
    {
        if ($request->has('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }
        return $query;
    }

    public function scopeCategory($query, $request)
    {
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        return $query;
    }

    public function scopePosition($query, $request)
    {
        if ($request->has('position_id')) {
            $query->where('position_id', $request->position_id);
        }
        return $query;
    }

    public function scopeCity($query, $request)
    {
        if ($request->has('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        return $query;
    }
}
