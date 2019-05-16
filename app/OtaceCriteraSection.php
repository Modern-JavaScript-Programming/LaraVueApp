<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtaceCriteriaSection extends Model
{
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_name'
    ];

    public function subSections()
    {
        return $this->hasMany('App\OtaceCriteriaSubsection');
    }
}
