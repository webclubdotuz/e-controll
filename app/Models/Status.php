<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name', 'color'];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
