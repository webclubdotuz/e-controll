<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
