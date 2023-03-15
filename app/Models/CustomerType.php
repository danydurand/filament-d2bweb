<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'price_list_id',
        'created_by',
        'updated_by',
        'must_be_sync',
        'sync_at'
    ];

    public $appends = [
        'customers_count'
    ];

    //------------
    // Additions
    //------------

    public function getCustomersCountAttribute()
    {
        return $this->customers()->count();
    }


    //----------------
    // Relationships
    //----------------

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
    public function price_list()
    {
        return $this->belongsTo(PriceList::class, 'price_list_id');
    }


}
