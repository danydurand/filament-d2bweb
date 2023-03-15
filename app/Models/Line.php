<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'category_id',
        'created_by',
        'updated_by',
        'must_be_sync',
        'sync_at'
    ];

    //----------------
    // Relationships
    //----------------

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
