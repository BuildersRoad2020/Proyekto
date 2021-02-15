<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Roles()
    {
        return $this->belongsTo(Roles::class); 
        //return $this->hasMany(Roles::class);        
    } 

    public function Contractors()
    {
        return $this->hasOne(Contractors::class);
    }
}    

