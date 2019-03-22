<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engagement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status',
    ];

    // An User belongs to many Engagement
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
