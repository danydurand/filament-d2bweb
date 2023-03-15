<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'fiscal_number',
        'business_name',
        'customer_type_id',
        'seller_id',
        'fiscal_address',
        'dispatch_address',
        'phones',
        'contact_name',
        'created_by',
        'updated_by',
        'must_be_sync',
        'sync_at'
    ];

    //------------
    // Additions
    //------------



    //----------------
    // Relationships
    //----------------

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function customer_type()
    {
        return $this->belongsTo(CustomerType::class);
    }

}
