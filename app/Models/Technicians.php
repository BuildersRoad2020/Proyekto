<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technicians extends Model
{
    use HasFactory;

    protected $fillable = [
        'contractors_id',
        'name',
        'role_users_id'
    ];

    public function Contractors()
    {
        return $this->belongsTo(Contractors::class);
    } 

    public function RoleUser()
    {
        return $this->hasOne(RoleUser::class, 'id'); //testing
    } 

}
