<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'contractors_id',
        'address',
        'city',
        'postcode',
        'state',
        'country',
        'abn',
        'name_primarycontact',
        'phone_primary',
        'email_primary',
        'name_secondarycontact',
        'phone_secondary',
        'email_secondary',
        'terms',
        'currency',
        'bankname',
        'branch',
        'accountname',
        'bsb',
        'accountnumber'
    ];

    public function Contractors()
    {
        return $this->belongsTo(Contractors::class);
    }    
    
/*     public function Countries()
    {
        return $this->belongsTo(Countries::class);
    }

    public function getCountriesAttribute()
    {
        return $this->Countries()->pluck('id','name')->first();
    }  */
}
