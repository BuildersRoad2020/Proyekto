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

    public function getContractorDetailsAttribute()
    {
        return $this->ContractorDetails()->pluck('id')->first();
    }
}
