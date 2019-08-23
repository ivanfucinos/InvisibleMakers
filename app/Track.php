<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    //

    public function scopeInProject($query, $project)
    {
        return $query->where('project', $project);
    }
}
