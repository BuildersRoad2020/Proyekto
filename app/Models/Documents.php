<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'required'
    ];

    public function Documents_Category()
    {
        return $this->belongsTo(Documents_Category::class);
    }  

    public function getDocuments_CategoryAttribute()
    {
        return $this->Documents_Category()->pluck('name')->get();
    }
}
