<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'order_id',
        'value',
        'activated'
    ];

    public function getValueAttribute($value)
    {
        return $this->encrypt_decrypt($value, 'decrypt');
    }
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $this->encrypt_decrypt($value, 'encrypt');
    }

    public function encrypt_decrypt($string, $action = 'encrypt')
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'j36L5LZI9OYdE2ajhxcs2r8v5Eu6'; // user define private key
        $secret_iv = '4d1vdRat9pu'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
