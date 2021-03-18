<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'user_id',
        'category_id',
        'sku',
        'name',
        'description',
        'price',
        'sale',
        'image',
        'rate'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function items(){
        return $this->hasMany('App\Models\Item');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] =  str_replace(' ', '-', $value);
    }
    public function getNameAttribute($value)
    {
        return str_replace('-', ' ', $value);
    }
}
