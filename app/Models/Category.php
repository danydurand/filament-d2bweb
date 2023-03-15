<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'created_by',
        'updated_by',
        'must_be_sync',
        'sync_at'
    ];


}
