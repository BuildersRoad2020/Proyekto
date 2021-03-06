<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractors extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_user_id',
        'name',
        'status'
    ];

    public function RoleUser()
    {
        return $this->belongsTo(RoleUser::class); //testing
    } 

    public function ContractorDetails()
    {
        return $this->hasOne(ContractorDetails::class);
    } 

    public function ContractorSkills()
    {
        return $this->hasMany(ContractorSkills::class);
    } 

    public function getContractorDetailsAttribute()
    {
        return $this->ContractorDetails()->pluck('id')->first();
    }

    public function Technicians()
    {
        return $this->hasMany(Technicians::class);
    } 

    public function getTechniciansAttribute()
    {
        return $this->Technicians()->pluck('id','name')->first();
    }
    

}
