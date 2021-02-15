<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function RoleUser()
    {
        return $this->hasMany(RoleUser::class);
    }    

}
