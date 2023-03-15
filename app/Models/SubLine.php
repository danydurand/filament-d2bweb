<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'linea_id',
        'created_by',
        'updated_by',
        'must_be_sync',
        'sync_at'
    ];

    public $appends = [
        'sub_lines_count'
    ];

    //------------
    // Additions
    //------------

    public function getSubLinesCountAttribute()
    {
        return $this->sub_lines()->count();
    }

    //----------------
    // Relationships
    //----------------

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

}
