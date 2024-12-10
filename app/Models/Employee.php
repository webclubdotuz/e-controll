<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'section_id',
        'fullname',
        'position',
        'phone',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
