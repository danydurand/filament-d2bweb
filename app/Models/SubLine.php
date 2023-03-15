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
        'must_be_sync',
        'sync_at'
    ];

    //----------------
    // Relationships
    //----------------

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

}
