<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sale_comission',
        'collect_comission',
        'login',
        'password',
        'last_login_at',
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

}
