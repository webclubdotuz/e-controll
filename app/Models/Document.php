<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'document_type_id',
        'reg_number',
        'reg_date',
        'organization_id',
        'deadline',
        'file',
        'description',
        'status_id'
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function documentSections()
    {
        return $this->hasMany(DocumentSection::class);
    }
}
