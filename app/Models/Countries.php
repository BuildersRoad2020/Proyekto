<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    public function Country()
    {
        return $this->hasMany(States::class);
    }   

/*     public function ContractorDetails()
    {
        return $this->hasOne(ContractorDetails::class);
    } */

}
