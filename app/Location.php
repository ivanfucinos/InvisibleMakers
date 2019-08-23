<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //

    public function scopeInProject($query, $project)
    {
        return $query->where('project', $project);
    }
}
