<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'price',
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
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order')->withPivot('qty');
    }
}
