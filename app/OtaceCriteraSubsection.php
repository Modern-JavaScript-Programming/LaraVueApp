<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtaceCriteriaSubsection extends Model
{
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id', 'subsection', 'subsection_desc'
    ];

    public function section()
    {
        return $this->belongsTo('App\OtaceCriteriaSection', 'section_id');
    }
}
