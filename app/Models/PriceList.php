<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public $appends = [
        'customer_types_count'
    ];

    public function getCustomerTypesCountAttribute()
    {
        return $this->customer_types()->count();
    }

    //----------------
    // Relationships
    //----------------

    public function customer_types()
    {
        return $this->hasMany(CustomerType::class);
    }




}
