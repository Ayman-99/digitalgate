<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    public $timestamps = false;

    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name'
    ];
    public function products(){
        return $this->hasMany("App\Models\Product");
    }
}
