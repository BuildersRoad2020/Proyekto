<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorSkills extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'skills_id',
        'contractors_id',
    ];

    public function Skills()
    {
        return $this->belongsTo(Skills::class);
    }      

    public function Contractors()
    {
        return $this->belongsTo(Contractors::class);
    }
}
