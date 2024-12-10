<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentSection extends Model
{

    protected $fillable = [
        'document_id',
        'section_id',
        'employee_id',
        'description',
        'deadline',
        'status_id',
        'file',
        'completed_at'
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
