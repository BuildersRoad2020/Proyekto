<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorDetails extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
