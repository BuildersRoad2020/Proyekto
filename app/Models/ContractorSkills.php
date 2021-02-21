<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorSkills extends Model
{
    use HasFactory;

    public function ContractorDetails()
    {
        return $this->belongsTo(Contractors::class);
    }     

    public function Skills()
    {
        return $this->belongsTo(Skills::class);
    }      
}
