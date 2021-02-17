<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'transaction',
        'total',
        'status'
    ];

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
